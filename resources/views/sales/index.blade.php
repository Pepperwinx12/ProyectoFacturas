@extends('welcome')

@section('content')
    <div class="max-w-7xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Ventas por Cliente</h1>

        <a href="{{ route('sales.create') }}" class="bg-green-500 text-white px-6 py-3 rounded">Crear nueva venta</a>

        <div class="mt-6 space-y-10">
            @foreach ($sales as $sale)
                <div class="bg-gray-50 p-4 rounded shadow">
                    <h2 class="text-xl font-semibold mb-2">Cliente: {{ $sale->customer->name }}</h2>

                    <table class="min-w-full table-auto border-collapse border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">ID Venta</th>
                                <th class="px-4 py-2 border">Tipo</th>
                                <th class="px-4 py-2 border">Serie</th>
                                <th class="px-4 py-2 border">Número</th>
                                <th class="px-4 py-2 border">Fecha</th>
                                <th class="px-4 py-2 border">Impuesto</th>
                                <th class="px-4 py-2 border">Total</th>
                                <th class="px-4 py-2 border" colspan="3">Acciones</th>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 border">{{ $sale->id }}</td>
                                <td class="px-4 py-2 border">{{ $sale->receipt_type }}</td>
                                <td class="px-4 py-2 border">{{ $sale->receipt_series }}</td>
                                <td class="px-4 py-2 border">{{ $sale->receipt_number }}</td>
                                <td class="px-4 py-2 border">{{ $sale->date_time }}</td>
                                <td class="px-4 py-2 border">${{ number_format($sale->tax, 2) }}</td>
                                <td class="px-4 py-2 border">${{ number_format($sale->total, 2) }}</td>
                                <td class="px-4 py-2 border text-center" colspan="3">
                                    <a href="{{ route('sales.invoice', $sale->id) }}" class="text-red-500 hover:underline">
                                        Generar Factura
                                    </a>
                                </td>
                            </tr>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 border" colspan="4">Producto</th>
                                <th class="px-4 py-2 border">Cantidad</th>
                                <th class="px-4 py-2 border" colspan="2">Precio Unitario</th>
                                <th class="px-4 py-2 border" colspan="3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->saleDetails as $detail)
                                <tr>
                                    <td class="px-4 py-2 border" colspan="4">{{ $detail->product->name }}</td>
                                    <td class="px-4 py-2 border">{{ $detail->quantity }}</td>
                                    <td class="px-4 py-2 border" colspan="2">${{ number_format($detail->price, 2) }}</td>
                                    <td class="px-4 py-2 border" colspan="3">
                                        ${{ number_format($detail->quantity * $detail->price, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
@endsection
