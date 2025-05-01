@extends('welcome')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Categorias</h1>

    <!-- Mostrar mensajes de éxito o error -->
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

    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Campo Nombre -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input
                type="text"
                name="name"
                id="name"
                class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400"
                value="{{ old('name') }}">
        </div>

        <!-- Campo Descripción -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea
                name="description"
                id="description"
                rows="5"
                class="mt-1 block w-full h-16 px-4 border border-gray-400 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-400">{{ old('description') }}</textarea>
        </div>

        <!-- Campo Condición -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <div class="flex items-center space-x-4 mt-2">
                <label class="flex items-center">
                    <input
                        type="radio"
                        name="condition"
                        value="1"
                        class="text-blue-500 focus:ring-blue-400"
                        checked>
                    <span class="ml-2 text-gray-700">Activo</span>
                </label>
                <label class="flex items-center">
                    <input
                        type="radio"
                        name="condition"
                        value="0"
                        class="text-blue-500 focus:ring-blue-400">
                    <span class="ml-2 text-gray-700">Inactivo</span>
                </label>
            </div>
        </div>

        <!-- Buttons -->

        <div class="flex justify-end space-x-3">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Guardar</button>
            <a href="{{ route('categories.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
            <a href="{{ route('categories.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Listas</a>
        </div>

    </form>


</div>

@endsection
