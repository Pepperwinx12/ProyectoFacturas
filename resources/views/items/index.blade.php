@extends('welcome')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Lista de artículos</h1>

        <!-- Mostrar mensajes de éxito -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full bg-gray-100 rounded">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2">Código</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Stock</th>
                    <th class="px-4 py-2">Imagen</th> 
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td class="px-4 py-2 border">{{ $item->code }}</td>
                        <td class="px-4 py-2 border">{{ $item->name }}</td>
                        <td class="px-4 py-2 border">{{ $item->stock }}</td>
                        <td class="px-4 py-2 border">
                            @if ($item->image)
                                <img src="{{ Storage::url('images/' . $item->image) }}" alt="Imagen del producto" class="w-40 h-40 object-cover mt-2">
                            @else
                                <span>No disponible</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('items.edit', $item) }}" class="text-blue-500">Editar</a>
                        </td>
                        <td class="px-4 py-2 border">
                            <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No hay productos para mostrar!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $items->links() }}
        </div>

        <!-- Botón de crear producto -->
        <div class="mt-6 flex justify-end">
            <a href="{{ route('items.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Crear producto</a>
        </div>
    </div>
@endsection
