@extends('welcome')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Crear artículo</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Código del Producto -->
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700">Código del producto:</label>
                <input type="text" name="code" class="w-full px-4 py-2 border rounded" value="Autogenerado" readonly />
            </div>

            <!-- Nombre del Producto -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre:</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded" value="{{ old('name') }}" />
            </div>

            <!-- Categoría -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría:</label>
                <select name="category_id" id="category_id" class="w-full px-4 py-2 border rounded">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Stock -->
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock:</label>
                <input type="number" name="stock" id="stock" class="w-full px-4 py-2 border rounded" value="{{ old('stock') }}" />
            </div>

            <!-- Precio -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Precio:</label>
                <input type="text" name="price" id="price" class="w-full px-4 py-2 border rounded" value="{{ old('price') }}" />
            </div>

            <!-- Estado -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Estado:</label>
                <div class="flex space-x-4 mt-2">
                    <label>
                        <input type="radio" name="status" value="1" checked />
                        Disponible
                    </label>
                    <label>
                        <input type="radio" name="status" value="0" />
                        No disponible
                    </label>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Imagen -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Imagen:</label>
                <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded" />
            </div>
        </div>

        <!-- Descripción -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Descripción:</label>
            <textarea name="description" id="description" class="w-full px-4 py-2 border rounded" rows="3">{{ old('description') }}</textarea>
        </div>

        <!-- Botones -->
            <div class="flex justify-end space-x-3">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Guardar</button>
                <a href="{{ route('items.create') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
                <a href="{{ route('items.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ver productos</a>
            </div>
    </form>
</div>
@endsection
