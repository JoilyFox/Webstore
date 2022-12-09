<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function getProduct($slug_category, $slug_subcategory, $slug_product) {
        if (!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());
        $product = Product::where('slug', $slug_product)->first();

        return view('product-page.index', [
            'product' => $product
        ]);
    }
}
