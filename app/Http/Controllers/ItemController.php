<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Item::query();

        // Filter by name (example)
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter by category (example)
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->paginate(10);
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
  

    $categories = Category::all(); // Cargar todas las categorías
    return view('items.create', compact('categories'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id', // Asegúrate de que la categoría exista
            'code' => 'required|max:500',
            'name' => 'required|max:255',
            'stock' => 'required|integer',
            'description' => 'required|max:255',
            'image' => 'required|max:255',
            'status' => 'required|boolean',
        ]);
    
        Item::create($validated);
    
        return redirect()->back()->with('success', 'Producto creado satisfactoriamente!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();  // Obtener todas las categorías
        return view('items.edit', compact('item', 'categories'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'code' => 'required|max:500',
        'name' => 'required|max:255',
        'stock' => 'required|integer',
        'description' => 'required|max:255',
        'image' => 'required|max:255',
        'status' => 'required|boolean',
    ]);

    $item->update($validated);

    return redirect()->route('items.index')->with('success', 'Producto actualizado satisfactoriamente');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Producto eliminado correctamente');
    }
}
