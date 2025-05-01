@extends('welcome')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Registrar Venta</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="customer_id" class="block text-sm font-medium text-gray-700">Cliente</label>
            <select name="customer_id" id="customer_id" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="receipt_type" class="block text-sm font-medium text-gray-700">Tipo de Recibo</label>
            <input type="text" name="receipt_type" id="receipt_type" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400" required>
        </div>

        <div>
            <label for="receipt_series" class="block text-sm font-medium text-gray-700">Serie de Recibo</label>
            <input type="text" name="receipt_series" id="receipt_series" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400">
        </div>

        <div>
            <label for="receipt_number" class="block text-sm font-medium text-gray-700">Número de Recibo</label>
            <input type="text" name="receipt_number" id="receipt_number" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400">
        </div>

        <div>
            <label for="tax" class="block text-sm font-medium text-gray-700">Impuesto</label>
            <input type="text" name="tax" id="tax" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400">
        </div>

        <div id="items" class="space-y-4">
            <div>
                <label for="product_id" class="block text-sm font-medium text-gray-700">Producto</label>
                <select name="items[0][product_id]" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400">
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Cantidad</label>
                <input type="number" name="items[0][quantity]" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400">
            </div>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Registrar Venta</button>
    </form>

    <a href="{{ route('sales.index') }}" class="inline-block mt-4 text-blue-500 hover:text-blue-700">Volver a la lista de ventas</a>
</div>

@endsection
