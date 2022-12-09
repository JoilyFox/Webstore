<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $products = Product::get();
        $product = Product::where('id', $request->id)->first();

        if (!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id);

        \Cart::add([
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => (int) 1,
            'attributes' => [
                'in_stock' => $product->in_stock,
                'img' => isset($product->images[0]->img) ? $product->images[0]->img : 'no_image.jpg',
                'size' => $request->size,
            ],

        ]);

        if ($request->ajax()) {
            return view('ajax.cart-items', [
                'products' => $products,
            ])->render();
        }

    }

    public function removeFromCart(Request $request) {
        $products = Product::get();
        
        \Cart::session($_COOKIE['cart_id']);
        \Cart::remove($request->id);

        if ($request->ajax()) {
            return view('ajax.cart-items', [
                'products' => $products,
            ])->render();
        }

    }
}
