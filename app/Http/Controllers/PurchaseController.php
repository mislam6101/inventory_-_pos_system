<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purcs = Purchase::with('category', 'supplier')->get();

        // dd($cats);

        return view('backend.purchase.index', compact('purcs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = Category::orderBy('name', 'asc')->get();
        $supp = Supplier::orderBy('name', 'asc')->get();

        return view('backend.purchase.create', compact('cats', 'supp'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'prod_name'       => 'required|string|max:255',
            'ref'       => 'required|string|max:255',
            'created_by'       => 'required|string|max:255',
            'prod_sku'        => 'required|string|max:255|unique:products,sku',
            'category_id'     => 'required|exists:categories,id',
            'supplier_id'     => 'required|exists:suppliers,id',
            'prod_price'      => 'required|numeric|min:0',
            'prod_dis_price'  => 'nullable|numeric|min:0',
            'shipping_cost'  => 'nullable|numeric|min:0',
            'grand_total'  => 'nullable|numeric|min:0',
            'prod_quantity'   => 'required|integer|min:0',
        ]);

        $data = [
            'name'         => $request->prod_name,
            'created_by'         => $request->created_by,
            'ref'         => $request->ref,
            'sku'          => $request->prod_sku,
            'category_id'  => $request->category_id,
            'supplier_id'  => $request->supplier_id,
            'price'        => $request->prod_price,
            'discount_price' => $request->prod_dis_price,
            'quantity'     => $request->prod_quantity,
            'shipping_cost'     => $request->shipping_cost,
            'grand_total'     => $request->grand_total,
        ];

        Purchase::create($data);

        // Redirect with success message
        return redirect()->route('purchase.index')->with('success', 'Add Perchase successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
