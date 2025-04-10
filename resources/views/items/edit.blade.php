@extends('welcome')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Actualizar articulos</h1>

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

        <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Grid para los campos del formulario -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre: </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm"
                        value="{{ old('name', $item->name) }}"
                    />
                </div>

                <!-- Categoría -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría: </label>
                    <select name="category_id" id="category_id" class="w-full px-4 py-2 border rounded">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Código -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Código: </label>
                    <input
                        type="text"
                        name="code"
                        id="code"
                        class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm"
                        value="{{ old('code', $item->code) }}"
                    />
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock: </label>
                    <input
                        type="number"
                        name="stock"
                        id="stock"
                        class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm"
                        value="{{ old('stock', $item->stock) }}"
                    />
                </div>

                <!-- Descripción -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descripción: </label>
                    <input
                        type="text"
                        name="description"
                        id="description"
                        class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm"
                        value="{{ old('description', $item->description) }}"
                    />
                </div>

                <!-- Imagen -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Imagen: </label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm"
                    />

                    <!-- Mostrar imagen actual si existe -->
                    @if ($item->image)
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Imagen actual:</p>
                            <img src="{{ asset('storage/images/' . $item->image) }}" alt="Imagen del producto" class="w-40 h-40 object-cover mt-2">
                        </div>
                    @endif
                </div>

                <!-- Estado -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Estado: </label>
                    <div class="flex items-center space-x-4 mt-2">
                        <label class="flex items-center">
                            <input
                                type="radio"
                                name="status"
                                value="1"
                                class="text-blue-500 focus:ring-blue-400"
                                {{ old('status', $item->status) == 1 ? 'checked' : '' }}
                            />
                            <span class="ml-2 text-gray-700">Activo</span>
                        </label>
                        <label class="flex items-center">
                            <input
                                type="radio"
                                name="status"
                                value="0"
                                class="text-blue-500 focus:ring-blue-400"
                                {{ old('status', $item->status) == 0 ? 'checked' : '' }}
                            />
                            <span class="ml-2 text-gray-700">Inactivo</span>
                        </label>
                    </div>
                </div>

            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Actualizar</button>
                <a href="{{ route('items.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
            </div>

        </form>
    </div>
@endsection
