<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Darryldecode\Cart\Validators\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();

        return view('admin.product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = Subcategory::all();

        return view('admin.product.create', [
            'subcategories' => $subcategories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:500',
            'price' => 'required|numeric|between:0.01,9999999.99',
            'in_stock' => 'required',
            'subcategory_id' => 'required',
            'images.*' => 'image|max:20000',
        ]);

        $new_product = new Product();
        $new_product->title          = $request->title;
        $new_product->slug           = Str::slug($request->title, '-');
        $new_product->description    = $request->description;
        $new_product->subcategory_id = $request->subcategory_id;
        $new_product->price          = $request->price;
        $new_product->in_stock       = $request->in_stock;
        $new_product->save();

        if ($request->file('images') != null) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->store('uploads', 'public');

                $new_product->images()->saveMany([
                    new ProductImage(['img' => $imageName]),
                ]);
            }
        }

        return redirect()->back()->withSuccess('Product has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $subcategories = Subcategory::all();

        return view('admin.product.edit', [
            'product' => $product,
            'subcategories' => $subcategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:500',
            'price' => 'required|numeric|between:0.01,9999999.99',
            'in_stock' => 'required',
            'subcategory_id' => 'required',
            'images.*' => 'image|max:20000',
        ]);

        $product->title          = $request->title;
        $product->slug           = Str::slug($request->title, '-');
        $product->description    = $request->description;
        $product->subcategory_id = $request->subcategory_id;
        $product->price          = $request->price;
        $product->in_stock       = $request->in_stock;
        $product->save();

        if ($request->file('images') != null) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->store('uploads', 'public');

                $product->images()->saveMany([
                    new ProductImage(['img' => $imageName]),
                ]);
            }
        }

        return redirect()->route('product.index')->withSuccess('Product has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->withSuccess('Product has been deleted successfully!');
    }
}
