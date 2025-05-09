@extends('welcome')

@section('content')
    @if (isset($isPdf) && $isPdf)
        <!-- Estilos para el PDF -->
        <style>
            /* Asegurarse de que el menú no se imprima en el PDF */
            nav, .menu, header {
                display: none !important;
            }

            body {
                font-family: 'Arial', sans-serif;
                line-height: 1.6;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }

            .container {
                width: 100%;
                margin: 0 auto;
                padding: 20px;
                max-width: 800px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
            }

            /* Encabezado */
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 30px;
            }

            .header .title {
                font-size: 28px;
                font-weight: bold;
                color: #333;
            }

            .header .date {
                text-align: right;
                font-size: 16px;
                color: #555;
            }

            .header .date p {
                margin: 5px 0;
            }

            /* Tabla Cliente y Comprobante */
            .client-table {
                width: 100%;
                margin-bottom: 30px;
                border-collapse: collapse;
            }

            .client-table th,
            .client-table td {
                padding: 12px;
                border: 1px solid #ddd;
                text-align: left; /* Alineación a la izquierda */
                font-size: 14px;
                color: #333;
            }

            .client-table th {
                background-color: #f4f4f4;
                font-weight: bold;
            }

            .client-table td {
                background-color: #fafafa;
            }

            /* Tabla de productos */
            .table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .table th,
            .table td {
                padding: 12px;
                border: 1px solid #ddd;
                text-align: left; /* Alineación a la izquierda */
                font-size: 14px;
                color: #333;
            }

            .table th {
                background-color: #f4f4f4;
                font-weight: bold;
            }

            .table tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            /* Total */
            .total {
                display: flex;
                justify-content: flex-end;
                margin-top: 20px;
                font-size: 18px;
                font-weight: bold;
                color: #333;
            }

            .total p {
                margin: 0;
                padding: 10px 20px;
                background-color: #e9e9e9;
                border-radius: 8px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }

        </style>
    @endif

    <!-- Contenido principal de la factura -->
    <div class="container">
        <div class="header">
            <div class="title">Factura de Venta</div>
            <div class="date">
                <p><strong>Fecha:</strong> {{ $sale->created_at->format('d/m/Y') }}</p>
                <p><strong>Venta #{{ $sale->id }}</strong></p>
            </div>
        </div>

        <!-- Tabla de Cliente y Comprobante -->
        <table class="client-table">
            <tr>
                <th>Cliente</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Comprobante</th>
            </tr>
            <tr>
                <td>{{ $sale->customer->name }}</td>
                <td>{{ $sale->customer->address }}</td>
                <td>{{ $sale->customer->phone }}</td>
                <td>{{ $sale->receipt_type }} #{{ $sale->receipt_number }}</td>
            </tr>
        </table>

        <!-- Tabla de Productos -->
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->saleDetails as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>${{ number_format($detail->product->price, 2) }}</td>
                        <td>${{ number_format($detail->quantity * $detail->product->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total -->
        <div class="total">
            <p>Total: ${{ number_format($sale->total, 2) }}</p>
        </div>
    </div>
@endsection
