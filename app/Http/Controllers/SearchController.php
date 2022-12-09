<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $search = $request->search;
        $products = Product::where('title', 'LIKE', "%{$search}%")->orderBy('title')->get();

        return view('search-page.index', [
            'products' => $products,
            'search' => $search,
        ]);
    }
}
