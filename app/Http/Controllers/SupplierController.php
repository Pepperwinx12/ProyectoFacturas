<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Supplier::query();

        // Filter by name ...

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' .$request->name. '%');
        }

        // Filter by Type of Document ...

        if ($request->filled('document_type')) {
            $query->where('document_type', $request->document_type);
        }

        // Filter by status ...

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $suppliers = $query->paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'document_type' => 'required|string|max:20',
            'document_number' => 'required|string|max:20',
            'address' => 'nullable|string|max:256',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100|unique:suppliers,email',
            'status' => 'required|boolean',
        ]);

        Supplier::create($validated);
        return redirect()->route('suppliers.create')->with('success', ' Supplier created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'document_type' => 'required|string|max:20',
            'document_number' => 'required|string|max:20',
            'address' => 'nullable|string|max:256',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'status' => 'required|boolean',
        ]);

        $supplier->update($validated);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully');
    }
}
