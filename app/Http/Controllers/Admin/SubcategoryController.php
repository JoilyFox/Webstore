<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::orderBy('created_at', 'desc')->get();

        return view('admin.subcategory.index', [
            'subcategories' => $subcategories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.subcategory.create', [
            'categories' => $categories,
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
            'category_id' => 'required',
        ]);

        $new_subcategory = new Subcategory();
        $new_subcategory->title = $request->title;
        $new_subcategory->slug = Str::slug($request->title, '-');
        $new_subcategory->category_id = $request->category_id;
        $new_subcategory->save();

        return redirect()->back()->withSuccess('Subcategory has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();

        return view('admin.subcategory.edit', [
            'subcategory' => $subcategory,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'title' => 'required|max:100',
            'category_id' => 'required',
        ]);
        
        $subcategory->title = $request->title;
        $subcategory->slug = Str::slug($request->title, '-');
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        return redirect()->route('subcategory.index')->withSuccess('Subcategory has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->back()->withSuccess('Subcategory has been deleted successfully!');
    }
}
