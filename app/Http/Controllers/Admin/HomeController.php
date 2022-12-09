<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $products_count = Product::all()->count();
        $categories_count = Category::all()->count();
        $subcategories_count = Subcategory::all()->count();
        $orders_count = Order::all()->count();

        return view('admin.home.index', [
            'products_count' => $products_count,
            'categories_count' => $categories_count,
            'subcategories_count' => $subcategories_count,
            'orders_count' => $orders_count,
        ]);
    }
}
