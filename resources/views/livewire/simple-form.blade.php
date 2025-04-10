<div class="p-4 bg-blue-100 rounded shadow">

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" id="name" wire:model="name" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm">
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
            Save
        </button>
    </form>
</div>
