<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!isset($_COOKIE['cart_id'])) {
            return redirect()->route('menWelcomePage')->with('error_message', 'No products in your cart!');
        } else {
            return view('checkout.index');  
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        try {
            if (count(\Cart::session($_COOKIE['cart_id'])->getContent()) > 0) {
                $charge = Stripe::charges()->create([
                    'amount' => \Cart::session($_COOKIE['cart_id'])->getSubTotal(),
                    'currency' => 'CAD',
                    'source' => $request->stripeToken,
                    'description' => 'Order from '.$request->name.' '.$request->surname.'. Email: '.$request->email.'. Products bought: '.\Cart::getTotalQuantity().'.',
                    'receipt_email' => $request->email,
                    'metadata' => [],
                ]);
    
                $request->validate([
                    'name' => 'required|max:100',
                    'surname' => 'required|max:100',
                    'email' => 'required|max:100',
                    'tel' => 'required|max:100',
                ]);
    
                $new_order = new Order();
                $new_order->name = $request->name;
                $new_order->surname = $request->surname;
                $new_order->email = $request->email;
                $new_order->tel = $request->tel;
                $new_order->save();
                
                foreach (\Cart::getContent() as $product) {
                    $new_order->products()->saveMany([
                        new OrderProduct([
                            'size' => $product->attributes->size,
                            'product_id' => $product->id,
                            'qty' => $product->quantity,
                        ]),
                    ]);
                }
    
                \Cart::clear();
                \Cart::session($_COOKIE['cart_id'])->clear();

                return redirect()->route('menWelcomePage')->with('success_message', 'Thank you! Your payment has been successfully accepted!');

            } else {
                return redirect()->back()->with('error_message', 'No products in your cart!');
            }
        } catch (CardErrorException $e) {
            $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
