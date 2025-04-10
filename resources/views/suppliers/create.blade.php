@extends('welcome')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Suppliers</h1>

    <!-- Show success messages -->
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Show validations errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-4">
        @csrf


        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded" value="{{ old('name') }}">
        </div>

        <!-- Tipo y Número de Documento -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="document_type" class="block text-sm font-medium text-gray-700">Document Type</label>
                <select name="document_type" id="document_type" class="w-full px-4 py-2 border rounded">
                    <option value="DNI">DNI</option>
                    <option value="RUC">RUC</option>
                    <option value="PASSPORT">Passport</option>
                    <option value="RIF">RIF</option>
                </select>
            </div>
            <div>
                <label for="document_number" class="block text-sm font-medium text-gray-700">Document number</label>
                <input type="text" name="document_number" id="document_number" class="w-full px-4 py-2 border rounded" value="{{ old('document_number') }}">
            </div>
        </div>


        <!-- Address -->
        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" name="address" id="address" class="w-full px-4 py-2 border rounded" value="{{ old('address') }}">
        </div>

        <!-- Phone and Email -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" id="phone" class="w-full px-4 py-2 border rounded" value="{{ old('phone') }}">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded" value="{{ old('email') }}">
            </div>
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <div class="flex space-x-4">
                <label><input type="radio" name="status" value="1" checked> Active</label>
                <label><input type="radio" name="status" value="0"> Inactive</label>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-3">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('suppliers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
            <a href="{{ route('suppliers.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">View List</a>
        </div>

    </form>

</div>



@endsection
