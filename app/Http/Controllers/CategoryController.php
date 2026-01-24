<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = Category::all();

        // dd($cats);

        return view('backend.category.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'cat_name' => 'required|min:3|max:12|unique:categories,name',
            ],
            [
                'required' => 'Category Name Must be Required',
                'min'      => 'Category Name Must be minimum 3 Character',
                'max'      => 'Category Name Must within 12 Character',
                'unique'   => 'Category Name already exists',
            ]
        );

        Category::create([
            'name' => $request->cat_name,
        ]);

        return redirect()
            ->route('category.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'cat_name' => 'required|max:12|min:3|unique:categories,name'
            ],
            [
                'required' => 'Category Name Must be Requiered',
                'min' => 'Category Name Must be minimum 3 Charecter Required',
                'max' => 'Category Name Must within 12 Charecter',
                'unique' => 'Category Name has already exist',
            ]
        );

        $category = Category::findOrFail($id);
        $category->name = $request->cat_name;
        $category->save();

        return redirect()
            ->route('category.index')
            ->with('success', 'Category updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()
            ->route('category.index')
            ->with('success', 'Category deleted successfully!');
    }
}
