@extends('welcome')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Lista de proveedores</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filters -->
    <div class="mb-6">
        <form action="{{ route('suppliers.index') }}" method="GET" class="flex space-x-4">
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

            <!-- Filter by Document Type -->
            <div>
                <select name="document_type" class="border border-gray-300 rounded px-4 py-2">
                    <option value="">Todos</option>
                    <option value="INE" {{ request('document_type') == 'INE' ? 'selected' : '' }}>INE</option>
                    <option value="RFC" {{ request('document_type') == 'RFC' ? 'selected' : '' }}>RFC</option>
                    <option value="Pasaporte" {{ request('document_type') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                </select>
            </div>

            <!-- Filter by Status -->
            <div>
                <select
                    name="status"
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
    @if(request('name') || request('condition') || request('document_type'))
        <div class="mb-4 p-3 bg-gray-100 rounded text-sm text-gray-700">
            <strong>Filters applied:</strong>
            <ul class="list-disc pl-4">
                @if(request('name'))
                    <li>Name: "{{ request('name') }}"</li>
                @endif
                @if(request('document_type'))
                    <li>Document Type: "{{ request('document_type') }}"</li>
                @endif
                @if(request('condition') !== null)
                    <li>Status: {{ request('condition') == '1' ? 'Active' : 'Inactive' }}</li>
                @endif
            </ul>
        </div>
    @endif

    <table class="table-auto w-full bg-gray-100 rounded">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Documento</th>
                <th class="px-4 py-2">Telefono</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2"></th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suppliers as $supplier)
                <tr>
                    <td class="border px-4 py-2">{{ $supplier->id }}</td>
                    <td class="border px-4 py-2">{{ $supplier->name }}</td>
                    <td class="border px-4 py-2">{{ $supplier->document_type }} - {{ $supplier->document_number }}</td>
                    <td class="border px-4 py-2">{{ $supplier->phone }}</td>
                    <td class="border px-4 py-2">
                        {{ $supplier->status ? 'Activo' : 'Inactivo' }}
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('suppliers.edit', $supplier) }}" class="text-blue-500 hover:underline">Editar</a>
                    </td>
                    <td class="border px-4 py-2">
                        <!-- Delete button -->
                        <button
                            onclick="confirmDelete({{ $supplier->id }})"
                            class="text-red-500 hover:underline"
                        >
                            Eliminar
                        </button>

                        <!-- Hidden form for deletion -->
                        <form
                            id="delete-form-{{ $supplier->id }}"
                            action="{{ route('suppliers.destroy', $supplier->id) }}"
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
                    <td colspan="6" class="text-center py-4">Proveedores no encontrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $suppliers->links() }}
    </div>

    <!-- Button for return to main form -->
    <div class="mt-4">
        <a href="{{ route('suppliers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Regresar</a>
    </div>
</div>

@section('scripts')
    <script>
        
        function confirmDelete(supplierId) {
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
                    document.getElementById(`delete-form-${supplierId}`).submit();
                }
            });
        }
    </script>
@endsection

@endsection
