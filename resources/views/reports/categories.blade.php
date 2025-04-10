@extends('welcome')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Generar Reporte de Categorías</h1>

    <form action="{{ route('category.report') }}" method="GET" class="space-y-4">
        @csrf

        <!-- Tipo de Reporte -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Tipo de Reporte</label>
            <select name="report_type" id="report_type" class="w-full px-4 py-2 border rounded" x-data="{ rangeEnabled: false }" @change="rangeEnabled = ($event.target.value === 'range')">
                <option value="all">Todas las Categorías</option>
                <option value="range">Por Rango de ID</option>
            </select>
        </div>

        <!-- Rango de ID (oculto por defecto) -->
        <div x-show="rangeEnabled" class="grid grid-cols-2 gap-4">
            <div>
                <label for="from_id" class="block text-sm font-medium text-gray-700">Desde ID</label>
                <input type="number" name="from_id" id="from_id" class="w-full px-4 py-2 border rounded">
            </div>
            <div>
                <label for="to_id" class="block text-sm font-medium text-gray-700">Hasta ID</label>
                <input type="number" name="to_id" id="to_id" class="w-full px-4 py-2 border rounded">
            </div>
        </div>

        <!-- Ordenar por -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Ordenar por</label>
            <select name="order_by" class="w-full px-4 py-2 border rounded">
                <option value="name">Nombre (A-Z)</option>
                <option value="condition">Estado (Activo/Inactivo)</option>
            </select>
        </div>

        <!-- Dónde abrir el reporte -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Abrir Reporte en</label>
            <select name="window" class="w-full px-4 py-2 border rounded" @change="windowTarget = ($event.target.value === 'new') ? '_blank' : ''">
                <option value="same">Misma ventana</option>
                <option value="new">Nueva ventana</option>
            </select>
        </div>

        <!-- Botones -->
        <div class="flex justify-end space-x-3">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Generar Reporte</button>
            <button type="reset" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
        </div>

    </form>
</div>
@endsection
