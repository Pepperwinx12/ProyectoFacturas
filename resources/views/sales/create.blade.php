@extends('welcome')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Registrar Venta</h1>

    <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
            <!-- Cliente -->
            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700">Cliente:</label>
                <select name="customer_id" id="customer_id" class="w-full border rounded px-3 py-2">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tipo de comprobante -->
            <div>
                <label for="receipt_type" class="block text-sm font-medium text-gray-700">Tipo de comprobante:</label>
                <select name="receipt_type" id="receipt_type" class="w-full border rounded px-3 py-2">
                    <option value="Factura">Factura</option>
                    <option value="Boleta">Boleta</option>
                </select>
            </div>

            <!-- Número de comprobante -->
            <div>
                <label for="receipt_number" class="block text-sm font-medium text-gray-700">N° comprobante:</label>
                <input type="text" name="receipt_number" class="w-full border rounded px-3 py-2" />
            </div>
        </div>

        <h2 class="text-lg font-semibold mb-2">Detalle de productos</h2>

        <div id="productContainer" class="space-y-4 mb-6">
            <!-- Producto dinámico -->
            <div class="grid grid-cols-6 gap-3 product-row">
                <select name="products[0][product_id]" class="col-span-2 border rounded px-2 py-1 product-select">
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="products[0][quantity]" class="border rounded px-2 py-1 quantity" value="1" min="1" />
                <input type="text" name="products[0][price]" class="border rounded px-2 py-1 price" readonly />
                <input type="text" class="border rounded px-2 py-1 subtotal" readonly />
                <button type="button" class="bg-red-500 text-white px-3 py-1 rounded remove-row">X</button>
            </div>
        </div>

        <button type="button" id="addProduct" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">+ Agregar producto</button>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Impuesto (%):</label>
                <input type="number" name="tax" id="tax" class="w-full border rounded px-2 py-1" value="18" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Total:</label>
                <input type="text" name="total" id="total" class="w-full border rounded px-2 py-1" readonly />
            </div>
        </div>

        <!-- Campos ocultos -->
        <input type="hidden" name="total" id="hiddenTotal" value="0" />
        <input type="hidden" name="total_sale" id="hiddenTotalSale" value="0" />

                   <div class="flex justify-end space-x-3">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Guardar</button>
                <a href="{{ route('sales.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
                <a href="{{ route('sales.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ver ventas</a>
            </div>
    </form>
</div>

<script>
    let index = 1;

    function recalculate() {
        let total = 0;
        document.querySelectorAll('.product-row').forEach(row => {
            const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
            const price = parseFloat(row.querySelector('.price').value) || 0;
            const subtotal = quantity * price;
            row.querySelector('.subtotal').value = subtotal.toFixed(2);
            total += subtotal;
        });

        const taxRate = parseFloat(document.getElementById('tax').value) || 0;
        const totalWithTax = total + (total * taxRate / 100);

        // Actualizar los campos ocultos
        document.getElementById('hiddenTotal').value = total.toFixed(2); // total sin impuestos
        document.getElementById('hiddenTotalSale').value = totalWithTax.toFixed(2); // total con impuestos

        // Actualizar el campo visible
        document.getElementById('total').value = totalWithTax.toFixed(2); // total con impuestos
    }

    function bindEvents(row) {
        const productSelect = row.querySelector('.product-select');
        const priceInput = row.querySelector('.price');
        const quantityInput = row.querySelector('.quantity');

        const updatePrice = () => {
            const price = productSelect.selectedOptions[0].dataset.price;
            priceInput.value = parseFloat(price).toFixed(2);
            recalculate();
        };

        productSelect.addEventListener('change', updatePrice);
        quantityInput.addEventListener('input', recalculate);

        row.querySelector('.remove-row').addEventListener('click', () => {
            row.remove();
            recalculate();
        });

        updatePrice();
    }

    document.getElementById('addProduct').addEventListener('click', () => {
        const container = document.getElementById('productContainer');
        const firstRow = container.querySelector('.product-row');
        const newRow = firstRow.cloneNode(true);

        newRow.querySelectorAll('select, input').forEach(input => {
            if (input.name.includes('product_id')) input.name = `products[${index}][product_id]`;
            if (input.name.includes('quantity')) input.name = `products[${index}][quantity]`;
            if (input.name.includes('price')) input.name = `products[${index}][price]`;
            input.value = '';
        });

        container.appendChild(newRow);
        bindEvents(newRow);
        index++;
    });

    document.querySelectorAll('.product-row').forEach(bindEvents);
    document.getElementById('tax').addEventListener('input', recalculate);
</script>
@endsection
