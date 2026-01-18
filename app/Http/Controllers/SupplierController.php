<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supp = Supplier::all();

        return view('backend.people.supplier.index', compact('supp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.people.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supp_name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:20',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Supplier::class],
            'address' => ['required', 'string', 'max:255'],
        ]);
        $data = [
            'name' => $request->supp_name,
            'contact' => $request->contact,
            'email' => $request->email,
            'address' => $request->address,
        ];

        Supplier::create($data);
        return redirect('/supplier');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('backend.people.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'supp_name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:20',
            'email'     => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('suppliers', 'email')->ignore($id),
            ],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $data = Supplier::findOrFail($id);
        $data->update([
            'name'    => $request->supp_name,
            'contact' => $request->contact,
            'email'   => $request->email,
            'address' => $request->address,
        ]);

        $data->save();

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Category deleted successfully!');
    }
}
