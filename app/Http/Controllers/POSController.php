<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\POS;
use App\Models\Product;
use Illuminate\Http\Request;

class POSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prods = Product::with('category')->get();
        $cats = Category::orderBy('name', 'asc')->get();

        return view('backend.pos', compact('prods', 'cats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(POS $pOS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(POS $pOS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, POS $pOS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(POS $pOS)
    {
        //
    }
}
