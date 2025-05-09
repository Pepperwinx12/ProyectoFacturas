@extends('welcome')

@section('content')
    <div class="max-w-7xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Productos</h1>

        <a href="{{ route('items.create') }}" class="bg-green-500 text-white px-6 py-3 rounded">Crear nuevo artículo</a>

        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full table-auto w-full bg-gray-100 rounded">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-2 text-left">Código</th>
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Categoría</th>
                        <th class="px-4 py-2 text-left">Stock</th>
                        <th class="px-4 py-2 text-left">Precio</th>
                        <th class="px-4 py-2 text-left">Estado</th>
                        <th class="px-4 py-2 text-left"></th>
                        <th class="px-4 py-2 text-left"></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td class="px-4 py-2 border">{{ $item->code }}</td>
                            <td class="px-4 py-2 border">{{ $item->name }}</td>
                            <td class="px-4 py-2 border">{{ $item->category->name }}</td>
                            <td class="px-4 py-2 border">{{ $item->stock }}</td>
                            <td class="px-4 py-2 border">${{ number_format($item->price, 2) }}</td>
                            <td class="px-4 py-2 border">{{ $item->status == 1 ? 'Disponible' : 'No disponible' }}</td>
                            <td class="px-4 py-2 border">
                                                 <!-- Edit button -->
                        <a href="{{ route('items.edit', $item->id) }}" class="text-blue-500 hover:underline">Editar</a>
                    </td>
                    <td class="border px-4 py-2">
                        <!-- Delete button -->
                        <button
                            onclick="confirmDelete({{ $item->id }})"
                            class="text-red-500 hover:underline"
                        >
                            Delete
                        </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @section('scripts')
        <script>
            function confirmDelete(itemId) {
                Swal.fire({
                    title: '¿Estás seguro de eliminar?',
                    text: "¡Por favor confirma la eliminación!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${itemId}`).submit();
                    }
                });
            }
        </script>
    @endsection

@endsection
