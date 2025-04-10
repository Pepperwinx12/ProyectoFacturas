<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Customer::query();

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

        $customers = $query->paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
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
            'email' => 'nullable|email|max:100|unique:customers,email',
            'status' => 'required|boolean',
        ]);

        Customer::create($validated);
        return redirect()->route('customers.create')->with('success', ' Cliente creado satisfactoriamente');
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
        $customer = Customer::findOrFail($id);

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
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

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Cliente actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Cliente eliminado satisfactoriamente');
    }
}
