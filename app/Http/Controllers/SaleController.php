<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Item;
use App\Models\Customer;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    // Mostrar el formulario para crear una venta
    public function create()
    {
        $customers = Customer::all();  // Trae todos los clientes
        $items = Item::all();  // Trae todos los productos
        return view('sales.create', compact('customers', 'items'));
    }

    // Almacenar la venta y los detalles de los productos vendidos
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
    
        // Crear la venta
        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'receipt_type' => $request->receipt_type,
            'receipt_series' => $request->receipt_series,
            'receipt_number' => $request->receipt_number,
            'date_time' => now(),
            'tax' => $request->tax,
            'total_sale' => collect($request->items)->sum(function ($item) {
                $product = Item::find($item['product_id']);
                return $product->price * $item['quantity'];
            }),
        ]);
    
        // Guardar los detalles de la venta
        foreach ($request->items as $item) {
            $product = Item::find($item['product_id']);
            // Verifica si el producto tiene precio
            if ($product && $product->price) {
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'item_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'discount' => $item['discount'] ?? 0,
                ]);
            } else {
                // Si el precio es nulo, podrías manejarlo de alguna manera
                return back()->withErrors(['price' => 'El producto no tiene un precio válido.']);
            }
        }
    
        return redirect()->route('sales.index')->with('success', 'Venta registrada con éxito');
    }

    public function index()
{
    // Obtener todas las ventas con los datos del cliente
    $sales = Sale::with('customer')->get();

    return view('sales.index', compact('sales'));
}

public function edit($id)
{
    // Obtener la venta a editar junto con los detalles de la venta
    $sale = Sale::with('saleDetails.item')->findOrFail($id);

    // Obtener todos los clientes y productos
    $customers = Customer::all();
    $items = Item::all();

    return view('sales.edit', compact('sale', 'customers', 'items'));
}

public function destroy($id)
{
    // Buscar la venta por ID
    $sale = Sale::findOrFail($id);

    // Eliminar la venta
    $sale->delete();

    // Redirigir con mensaje de éxito
    return redirect()->route('sales.index')->with('success', 'Venta eliminada con éxito');
}

    
}
