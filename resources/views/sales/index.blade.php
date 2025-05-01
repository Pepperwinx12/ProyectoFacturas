@extends('welcome')

@section('content')

<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Ventas Registradas</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b text-left">Cliente</th>
                <th class="px-4 py-2 border-b text-left">Tipo de Recibo</th>
                <th class="px-4 py-2 border-b text-left">Serie y Número</th>
                <th class="px-4 py-2 border-b text-left">Fecha y Hora</th>
                <th class="px-4 py-2 border-b text-left">Impuesto</th>
                <th class="px-4 py-2 border-b text-left">Total</th>
                <th class="px-4 py-2 border-b text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td class="px-4 py-2 border-b">{{ $sale->customer->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $sale->receipt_type }}</td>
                    <td class="px-4 py-2 border-b">{{ $sale->receipt_series }} - {{ $sale->receipt_number }}</td>
                    <td class="px-4 py-2 border-b">{{ $sale->date_time }}</td>
                    <td class="px-4 py-2 border-b">${{ number_format($sale->tax, 2) }}</td>
                    <td class="px-4 py-2 border-b">${{ number_format($sale->total_sale, 2) }}</td>
                    <td class="px-4 py-2 border-b">
                        <a href="{{ route('sales.edit', $sale->id) }}" class="text-blue-500 hover:text-blue-700">Editar</a> |
                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <a href="{{ route('sales.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Registrar Nueva Venta</a>
    </div>
</div>

@endsection
