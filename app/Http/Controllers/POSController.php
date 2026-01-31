<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\POS;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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
        return view('backend.pay');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'c_name' => 'required|string|max:255',
            'cont' => 'required|numeric|min:0',
        ]);

        $cartData = $request->cart;

        //  common info
        $common_id = $cartData['common_id'];
        $c_name = $cartData['c_name'];
        $cont = $cartData['cont'];

        $total = $request->total;

        //  create Sale record
        $sale = Sale::create([
            'common_id' => $common_id,
            'c_name' => $c_name,
            'cont' => $cont,
            'total' => $total,
        ]);

        //  create SaleItem records
        foreach ($cartData['items'] as $item) {
            $sale->items()->create([
                'name' => $item['name'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        //  redirect to invoice page
        return response()->json([
            'success' => true,
            'invoice_url' => route('invoice.show', $common_id)
        ]);
    }


    public function sales()
    {
        // Eager load kore items
        $sales = Sale::with('items')->orderBy('created_at', 'desc')->get();

        return view('backend.sale.index', compact('sales'));
    }

    public function invoice($id)
    {
        $sale = Sale::with('items')->where('common_id', $id)->firstOrFail();

        return view('pdfs.invoice', ['sales' => [$sale]]);
    }

    public function downloadInvoice($id)
    {
        // Sale with items
        $sale = Sale::with('items')->where('common_id', $id)->firstOrFail();

        $sales = collect([$sale]);
        // Load Blade view for PDF
        $pdf = PDF::loadView('pdfs.invoice', compact('sales'));

        // Download PDF
        return $pdf->stream('Invoicfilename: e_' . $sale->common_id . '.pdf');
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
