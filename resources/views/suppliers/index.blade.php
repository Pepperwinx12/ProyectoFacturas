@extends('welcome')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Suppliers List</h1>

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
                    <option value="">All</option>
                    <option value="DNI" {{ request('document_type') == 'DNI' ? 'selected' : '' }}>DNI</option>
                    <option value="RUC" {{ request('document_type') == 'RUC' ? 'selected' : '' }}>RUC</option>
                    <option value="PASSPORT" {{ request('document_type') == 'PASSPORT' ? 'selected' : '' }}>Passport</option>
                    <option value="RIF" {{ request('document_type') == 'RIF' ? 'selected' : '' }}>RIF</option>
                </select>
            </div>

            <!-- Filter by Status -->
            <div>
                <select
                    name="status"
                    class="border border-gray-300 rounded px-4 py-2"
                >
                    <option value="">All</option>
                    <option value="1" {{ request('condition') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('condition') == '0' ? 'selected' : '' }}>Inactive</option>
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
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Document</th>
                <th class="px-4 py-2">Phone</th>
                <th class="px-4 py-2">Status</th>
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
                        <a href="{{ route('suppliers.edit', $supplier) }}" class="text-blue-500 hover:underline">Edit</a>
                    </td>
                    <td class="border px-4 py-2">
                        <!-- Delete button -->
                        <button
                            onclick="confirmDelete({{ $supplier->id }})"
                            class="text-red-500 hover:underline"
                        >
                            Delete
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
                    <td colspan="6" class="text-center py-4">Suppliers not found.</td>
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
        <a href="{{ route('suppliers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Return to Form</a>
    </div>
</div>

@endsection
