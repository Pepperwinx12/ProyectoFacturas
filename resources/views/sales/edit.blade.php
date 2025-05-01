@extends('welcome')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Editar Venta</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('sales.update', $sale->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="customer_id" class="block text-sm font-medium text-gray-700">Cliente</label>
            <select name="customer_id" id="customer_id" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $sale->customer_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="receipt_type" class="block text-sm font-medium text-gray-700">Tipo de Recibo</label>
            <input type="text" name="receipt_type" id="receipt_type" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400" value="{{ $sale->receipt_type }}" required>
        </div>

        <div>
            <label for="receipt_series" class="block text-sm font-medium text-gray-700">Serie de Recibo</label>
            <input type="text" name="receipt_series" id="receipt_series" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400" value="{{ $sale->receipt_series }}">
        </div>

        <div>
            <label for="receipt_number" class="block text-sm font-medium text-gray-700">Número de Recibo</label>
            <input type="text" name="receipt_number" id="receipt_number" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400" value="{{ $sale->receipt_number }}">
        </div>

        <div>
            <label for="tax" class="block text-sm font-medium text-gray-700">Impuesto</label>
            <input type="text" name="tax" id="tax" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400" value="{{ $sale->tax }}">
        </div>

        <div id="items" class="space-y-4">
            @foreach ($sale->saleDetails as $key => $detail)
                <div>
                    <label for="product_id" class="block text-sm font-medium text-gray-700">Producto</label>
                    <select name="items[{{ $key }}][product_id]" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400">
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}" {{ $detail->item_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Cantidad</label>
                    <input type="number" name="items[{{ $key }}][quantity]" class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400" value="{{ $detail->quantity }}">
                </div>
            @endforeach
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Actualizar Venta</button>
    </form>
</div>

@endsection
