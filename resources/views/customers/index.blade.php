@extends('welcome')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Lista de clientes</h1>

    <!-- Show messages (success) -->
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6">
        <form action="{{ route('customers.index') }}" method="GET" class="flex space-x-4">

            <!-- Filter by name -->
            <div>
                <input
                    type="text"
                    name="name"
                    placeholder="Search by name..."
                    value="{{ request('name') }}"
                    class="border border-gray-300 rounded px-4 py-2"
                />
            </div>

            <!-- Filter by Type of Document -->
            <div>
                <select
                    name="document_type"
                    class="border border-gray-300 rounded px-4 py-2"
                >
                    <option value="">All</option>
                    <option value="DNI" {{ request('document_type') == 'DNI' ? 'selected' : '' }}>DNI</option>
                    <option value="RUC" {{ request('document_type') == 'RUC' ? 'selected' : '' }}>RUC</option>
                    <option value="PASSPORT" {{ request('document_type') == 'PASSPORT' ? 'selected' : '' }}>PASSPORT</option>
                    <option value="RIF" {{ request('document_type') == 'RIF' ? 'selected' : '' }}>RIF</option>
                </select>
            </div>

            <!-- Filter by status -->
            <div>
                <select
                    name="status"
                    class="border border-gray-300 rounded px-4 py-2"
                >
                    <option value="">All</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
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

    <!-- Filters applied -->

    @if (request('name') || request('document_type') || request('status'))
        <div class="mb-4 p-3 bg-gray-100 rounded text-sm text-gray-700">
            <strong>Filters applied:</strong>
            <ul class="list-disc pl-4">
                @if (request('name'))
                    <li>Name: "{{ request('name') }}"</li>
                @endif
                @if (request('document_type'))
                    <li>Type of Document: "{{ request('document_type') }}"</li>
                @endif
                @if (request('status') !== null)
                    <li>Status: {{ request('status') == '1' ? 'Active' : 'Inactive' }}</li>
                @endif
            </ul>
        </div>
    @endif

    <!-- Customers table -->

    <table class="table-auto w-full bg-gray-100 rounded">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Document</th>
                <th class="px-4 py-2">Phone</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2"></th>
                <th class="px-4 py-2"></th>

            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td class="border px-4 py-2">{{ $customer->id }}</td>
                    <td class="border px-4 py-2">{{ $customer->name }}</td>
                    <td class="border px-4 py-2">
                        {{ $customer->document_type }} - {{ $customer->document_number }}
                    </td>
                    <td class="border px-4 py-2">{{ $customer->phone }}</td>
                    <td class="border px-4 py-2">
                        {{ $customer->status ? 'Active' : 'Inactive' }}
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('customers.edit', $customer->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    </td>
                    <td class="border px-4 py-2">
                        <button
                            onclick="confirmDelete({{ $customer->id }})"
                            class="text-red-500 hover:underline"
                        >
                            Delete
                        </button>
                    </td>

                    <form
                        id="delete-form-{{ $customer->id }}"
                        action="{{ route('customers.destroy', $customer->id) }}"
                        method="POST"
                        class="display:none;"
                    >
                        @csrf
                        @method('DELETE')
                    </form>

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">
                        No customers registered!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->

    <div class="mt-4">
        {{ $customers->links() }}
    </div>

    <!-- Button for return to main form -->

    <div class="mt-4">
        <a href="{{ route('customers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Return to the Form</a>
    </div>

</div>

<script>
    function confirmDelete(customerId) {
        Swal.fire({
            title: '¿Are you sure to delete?',
            text: "¡Confirm delete, please!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send the deletion form
                document.getElementById(`delete-form-${customerId}`).submit();
            }
        });
    }
</script>

@endsection
