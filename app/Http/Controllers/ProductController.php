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
        $request->validate(
            [
                'prod_name'       => 'required|string|max:255',
                'prod_sku'        => 'required|string|max:255|unique:products,sku',
                'category_id'     => 'required|exists:categories,id',
                'prod_price'      => 'required|numeric|min:0',
                'prod_dis_price'  => 'nullable|numeric|min:0',
                'prod_quantity'   => 'required|integer|min:0',
                'prod_status'     => 'required|boolean',
                'prod_details'    => 'nullable|string|max:200',
                'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'prod_name.required'     => 'Product name is required.',
                'prod_name.string'       => 'Product name must be a valid string.',
                'prod_name.max'          => 'Product name may not exceed 255 characters.',

                'prod_sku.required'      => 'Product SKU is required.',
                'prod_sku.string'        => 'Product SKU must be a valid string.',
                'prod_sku.unique'        => 'This SKU has already been taken.',

                'category_id.required'   => 'Please select a category.',
                'category_id.exists'     => 'The selected category is invalid.',

                'prod_price.required'    => 'Product price is required.',
                'prod_price.numeric'     => 'Product price must be a number.',
                'prod_price.min'         => 'Product price must be at least 0.',

                'prod_dis_price.numeric' => 'Discount price must be a number.',
                'prod_dis_price.min'     => 'Discount price must be at least 0.',

                'prod_quantity.required' => 'Product quantity is required.',
                'prod_quantity.integer'  => 'Product quantity must be a number.',
                'prod_quantity.min'      => 'Product quantity must be at least 0.',

                'prod_status.required'   => 'Product status is required.',

                'prod_details.max'       => 'Product description may not exceed 200 characters.',

                'image.image'            => 'The uploaded file must be an image.',
                'image.mimes'            => 'The image must be a file of type: jpeg, png, jpg, gif.',
                'image.max'              => 'The image size must not exceed 2MB.',
            ]
        );

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
    public function decreaseStock(Request $request)
    {
        $product = Product::find($request->id);
        if ($product->quantity > 0) {
            $product->decrement('quantity');
        }
        return response()->json(['quantity' => $product->quantity]);
    }

    public function increaseStock(Request $request)
    {
        $product = Product::find($request->id);
        $product->increment('quantity', $request->qty);
        return response()->json(['quantity' => $product->quantity]);
    }
}
