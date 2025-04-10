@extends('welcome')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Lista de categorias</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filters -->
    <div class="mb-6">
        <form action="{{ route('categories.index') }}" method="GET" class="flex space-x-4">
            <!-- Filter by name -->
            <div>
                <input
                    type="text"
                    name="name"
                    placeholder="Search by name"
                    value="{{ request('name') }}"
                    class="border border-gray-300 rounded px-4 py-2"
                />
            </div>

            <!-- Filter by Status -->
            <div>
                <select
                    name="condition"
                    class="border border-gray-300 rounded px-4 py-2"
                >
                    <option value="">All</option>
                    <option value="1" {{ request('condition') == '1' ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ request('condition') == '0' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <!-- Search Button -->
            <div>
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Filters Applied -->
    @if(request('name') || request('condition'))
        <div class="mb-4 p-3 bg-gray-100 rounded text-sm text-gray-700">
            <strong>Filtros aplicados:</strong>
            <ul class="list-disc pl-4">
                @if(request('name'))
                    <li>Name: "{{ request('name') }}"</li>
                @endif
                @if(request('condition') !== null)
                    <li>Status: {{ request('condition') == '1' ? 'Active' : 'Inactive' }}</li>
                @endif
            </ul>
        </div>
    @endif

    <!-- Suppliers Table -->
    <table class="table-auto w-full bg-gray-100 rounded">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Descripcion</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2"></th>
                <th class="px-4 py-2"></th>

            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td class="border px-4 py-2">{{ $category->id }}</td>
                    <td class="border px-4 py-2">{{ $category->name }}</td>
                    <td class="border px-4 py-2">{{ $category->description }}</td>
                    <td class="border px-4 py-2">
                        {{ $category->condition ? 'Active' : 'Inactive' }}
                    </td>
                    <td class="border px-4 py-2">
                        <!-- Edit button -->
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500 hover:underline">Editar</a>
                    </td>
                    <td class="border px-4 py-2">
                        <!-- Delete button -->
                        <button
                            onclick="confirmDelete({{ $category->id }})"
                            class="text-red-500 hover:underline"
                        >
                            Delete
                        </button>

                        <!-- Hidden form for deletion -->
                        <form
                            id="delete-form-{{ $category->id }}"
                            action="{{ route('categories.destroy', $category->id) }}"
                            method="POST"
                            style="display: none;"
                        >
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No hay categorias para mostrar!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginate -->
    <div class="mt-4">
        {{ $categories->links() }}
    </div>

    <!-- Button for return to main form -->
    <div class="mt-4">
        <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Return to Form</a>
    </div>
</div>

<script>
    function confirmDelete(categoryId) {
        Swal.fire({
            title: 'Estas seguro?',
            text: "Esto lo eliminara para siempre",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send the deletion form
                document.getElementById(`delete-form-${categoryId}`).submit();
            }
        });
    }
</script>
@endsection
