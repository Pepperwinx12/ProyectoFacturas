<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function index()
    {
       $sales = Sale::with(['customer', 'saleDetails.item'])->get();
    return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        $items = Item::where('status', 1)->get(); // Solo productos disponibles
        return view('sales.create', compact('customers', 'items'));
    }


   // Método para generar la factura
   public function generateInvoice($saleId)
{
    // Obtener la venta junto con el cliente y los detalles de la venta (productos)
    $sale = Sale::with(['customer', 'saleDetails.product'])->findOrFail($saleId);

    // Definir si es para generar un PDF
    $isPdf = true;

    // Generar el PDF de la factura
    $pdf = Pdf::loadView('sales.invoice', compact('sale', 'isPdf'));

    // Descargar el PDF con el nombre 'factura_venta_X.pdf' (donde X es el ID de la venta)
    return $pdf->download('factura_venta_' . $sale->id . '.pdf');
}

public function store(Request $request)
{
    // Validación de los datos
    $validated = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'receipt_type' => 'required|string',
        'receipt_number' => 'required|string',
        'tax' => 'required|numeric',
        'products' => 'required|array',
        'total' => 'required|numeric',       // Validar total
        'total_sale' => 'required|numeric',  // Validar total_sale
    ]);

    // Obtener los productos
    $products = $request->input('products');
    $total = $request->total;  // Total antes de impuestos
    $totalSale = $request->total_sale;  // Total con impuestos

    // Crear la venta en la base de datos
    $sale = Sale::create([
        'customer_id' => $request->customer_id,
        'receipt_type' => $request->receipt_type,
        'receipt_number' => $request->receipt_number,
        'tax' => $request->tax,
        'total' => $total,
        'total_sale' => $totalSale,
        'date_time' => now(),
    ]);

    // Agregar los detalles de los productos
    foreach ($products as $product) {
        SaleDetail::create([
            'sale_id' => $sale->id,
            'product_id' => $product['product_id'],
            'quantity' => $product['quantity'],
            'price' => $product['price'],
        ]);
    }

    // Redirigir con mensaje de éxito
    return redirect()->route('sales.index')->with('success', 'Venta registrada exitosamente');
}


    public function show($id)
    {
        $sale = Sale::with('customer', 'details.item')->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Venta eliminada.');
    }
}
