@extends('welcome')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Update Suppliers</h1>

        <!-- Show messages (error) -->

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('suppliers.update', $supplier) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- fields of our form -->

            <!-- Name -->

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name: </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm"
                    value="{{ old('name', $supplier->name) }}"
                />
            </div>

            <!-- Type of Document -->

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="document_type" class="block text-sm font-medium text-gray-700">
                        Type of Document
                    </label>
                    <select name="document_type" id="document_type" class="w-full px-4 py-2 border rounded">
                        <option value="DNI" {{ $supplier->document_type == "DNI" ? 'selected' : '' }}>DNI</option>
                        <option value="RUC" {{ $supplier->document_type == "RUC" ? 'selected' : '' }}>RUC</option>
                        <option value="PASSPORT" {{ $supplier->document_type == "PASSPORT" ? 'selected' : '' }}>PASSPORT</option>
                        <option value="RIF" {{ $supplier->document_type == "RIF" ? 'selected' : '' }}>RIF</option>
                    </select>
                </div>
                <div>
                    <label for="document_number" class="block text-sm font-medium text-gray-700">Document number: </label>
                    <input
                        type="text"
                        name="document_number"
                        id="document_number"
                        class="w-full px-4 py-2 border rounded"
                        value="{{ old('document_number', $supplier->document_number) }}"
                    />
                </div>
            </div>

            <!-- Address -->

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address: </label>
                <input
                    type="text"
                    name="address"
                    id="address"
                    class="mt-1 block w-full h-10 px-4 border border-gray-400 rounded-md shadow-sm"
                    value="{{ old('address', $supplier->address) }}"
                />
            </div>

            <!-- Phone and Email -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone: </label>
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        class="w-full px-4 py-2 border rounded"
                        value="{{ old('phone', $supplier->phone) }}"
                    />
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail: </label>
                    <input
                        type="text"
                        name="email"
                        id="email"
                        class="w-full px-4 py-2 border rounded"
                        value="{{ old('email', $supplier->email) }}"
                    />
                </div>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Status: </label>
                <div class="flex items-center space-x-4 mt-2">
                    <label class="flex items-center">
                        <input
                            type="radio"
                            name="status"
                            value="1"
                            class="text-blue-500 focus:ring-blue-400"
                            {{ old('status', $supplier->status) == 1 ? 'checked' : ''}}
                        />
                        <span class="ml-2 text-gray-700">Active</span>
                    </label>
                    <label class="flex items-center">
                        <input
                            type="radio"
                            name="status"
                            value="0"
                            class="text-blue-500 focus:ring-blue-400"
                            {{ old('status', $supplier->status) == 0 ? 'checked' : ''}}
                        />
                        <span class="ml-2 text-gray-700">Inactive</span>
                    </label>
                </div>
            </div>

            <!-- Buttons -->

            <div class="flex justify-end space-x-3">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('suppliers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
            </div>

        </form>

    </div>
@endsection
