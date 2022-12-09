<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryPagesController extends Controller
{
    public function getProductsByCategory(Request $request, $slug_category, $slug_subcategory) {
        $current_subcategory = Subcategory::where('slug', $slug_subcategory)->first();
        $products = Subcategory::where('slug', $slug_subcategory)->first()->products()->get();

        if (isset($request->orderBy)) {
            
            switch ($request->orderBy) {
                case 'price-low-high':
                    $products = Subcategory::where('slug', $slug_subcategory)
                        ->first()
                        ->products()
                        ->orderBy('price')
                        ->get();
                    break;
                case 'price-high-low': 
                    $products = Subcategory::where('slug', $slug_subcategory)
                        ->first()
                        ->products()
                        ->orderBy('price', 'desc')
                        ->get();
                    break;
                case 'name-a-z': 
                    $products = Subcategory::where('slug', $slug_subcategory)
                        ->first()
                        ->products()
                        ->orderBy('title')
                        ->get();
                    break;
                case 'name-z-a': 
                    $products = Subcategory::where('slug', $slug_subcategory)
                        ->first()
                        ->products()
                        ->orderBy('title', 'desc')
                        ->get();
                default: 
                    $products = Subcategory::where('slug', $slug_subcategory)
                        ->first()
                        ->products()
                        ->get();
            }
        }

        if (isset($request->orderByPrice)) {
            $productsQuery = Subcategory::where('slug', $slug_subcategory)->first()->products();
            
            if ($request->orderByPrice !== 'default') {
                $productsQuery = $productsQuery->where('price', '<=', $request->orderByPrice);
            }
            $products = $productsQuery->get();
        }

        if ($request->ajax()) {
            return view('ajax.order-by', [
                'products' => $products,
            ])->render();
        }

        return view('category-page.index', [
            'products' => $products,
            'current_subcategory' => $current_subcategory

        ]);
    }
}
