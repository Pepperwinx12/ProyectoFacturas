@extends('welcome')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Crear Producto</h1>

        <!-- Mostrar mensajes de éxito -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Mostrar mensajes de error -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('items.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Fila con Código y Nombre -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Código -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Código del producto: </label>
                    <input
                        type="text"
                        name="code"
                        id="code"
                        class="w-full px-4 py-2 border rounded"
                        value="{{ old('code') }}"
                    />
                </div>

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre: </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="w-full px-4 py-2 border rounded"
                        value="{{ old('name') }}"
                    />
                </div>
            </div>

            <!-- Fila con Categoría y Stock -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Categoría -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría: </label>
                    <select name="category_id" id="category_id" class="w-full px-4 py-2 border rounded">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock: </label>
                    <input
                        type="number"
                        name="stock"
                        id="stock"
                        class="w-full px-4 py-2 border rounded"
                        value="{{ old('stock') }}"
                    />
                </div>
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción: </label>
                <textarea
                    name="description"
                    id="description"
                    class="w-full px-4 py-2 border rounded"
                    rows="4">{{ old('description') }}</textarea>
            </div>

            <!-- Imagen -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Imagen: </label>
                <input
                    type="file"
                    name="image"
                    id="image"
                    class="w-full px-4 py-2 border rounded"
                />
            </div>

            <!-- Fila con Estado -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Estado -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Estado: </label>
                    <div class="flex space-x-4">
                        <label>
                            <input
                                type="radio"
                                name="status"
                                value="1"
                                checked
                            />
                            Disponible
                        </label>
                        <label>
                            <input
                                type="radio"
                                name="status"
                                value="0"
                            />
                            No disponible
                        </label>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3 mt-6">
                <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded">Guardar</button>
                <a href="{{ route('items.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded">Cancelar</a>
                <a href="{{ route('items.index') }}" class="bg-blue-500 text-white px-6 py-3 rounded">Ver productos</a>
            </div>

        </form>
    </div>
@endsection
