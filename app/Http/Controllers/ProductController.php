<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prods = Product::with('category')->get();

        // dd($cats);

        return view('backend.product.index', compact('prods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = Category::orderBy('name', 'asc')->get();

        return view('backend.product.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'prod_name'       => 'required|string|max:255',
            'prod_sku'        => 'required|string|max:255|unique:products,sku',
            'category_id'     => 'required|exists:categories,id',
            'prod_price'      => 'required|numeric|min:0',
            'prod_dis_price'  => 'nullable|numeric|min:0',
            'prod_quantity'   => 'required|integer|min:0',
            'prod_status'     => 'required|boolean',
            'prod_details'    => 'nullable|string|max:1000',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name'         => $request->prod_name,
            'sku'          => $request->prod_sku,
            'category_id'  => $request->category_id,
            'price'        => $request->prod_price,
            'discount_price' => $request->prod_dis_price,
            'quantity'     => $request->prod_quantity,
            'status'       => $request->prod_status,
            'description'  => $request->prod_details,
        ];

        // Image upload
        if ($request->hasFile('image')) {
            $image    = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/products', $filename);
            $data['image'] = $filename;
        }

        // Create Product
        Product::create($data);

        // Redirect with success message
        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
