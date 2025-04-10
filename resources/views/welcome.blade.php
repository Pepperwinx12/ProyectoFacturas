<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de facturación</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" defer></script>
</head>
<body class="bg-gray-100 font-sans flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-gradient-to-r from-purple-600 to-pink-500 text-white px-6 py-4 flex justify-between items-center shadow-md rounded-b-2xl">
        <h1 class="text-lg font-bold">Sistema de facturación</h1>
        <div class="text-sm font-medium">Admin user</div>
    </header>

    <!-- Contenido Principal -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

    <!-- Navbar Inferior -->
    <nav class="bg-gradient-to-r from-purple-600 to-indigo-500 text-white fixed bottom-4 left-1/2 transform -translate-x-1/2 w-[90%] max-w-[800px] p-3 flex justify-around items-center rounded-2xl shadow-lg z-50">

        <a href="/" class="flex flex-col items-center text-xs transition-transform duration-200 ease-out hover:scale-110">
            <i class="ph ph-house-simple text-3xl"></i>
            <span class="text-[10px]">Inicio</span>
        </a>

        <!-- Categorías -->
        <div class="relative group">
            <button class="flex flex-col items-center text-xs transition-transform duration-200 ease-out hover:scale-110 focus:outline-none">
                <i class="ph ph-list text-3xl"></i>
                <span class="text-[10px]">Categorías</span>
            </button>
            <div class="absolute bottom-full mb-2 bg-gradient-to-r from-purple-600 to-indigo-500 text-white rounded-xl shadow-xl py-2 w-40 text-left z-50 origin-bottom group-hover:block hidden">
                <a href="{{ route('categories.create') }}" class="block px-4 py-2 hover:bg-purple-700 transition">📂 Datos</a>
                <a href="{{ route('reports.categories') }}" class="block px-4 py-2 hover:bg-purple-700 transition">📊 Reportes</a>
            </div>
        </div>

        <!-- Proveedores -->
        <div class="relative group">
            <button class="flex flex-col items-center text-xs transition-transform duration-200 ease-out hover:scale-110 focus:outline-none">
                <i class="ph ph-truck text-3xl"></i>
                <span class="text-[10px]">Proveedores</span>
            </button>
            <div class="absolute bottom-full mb-2 bg-gradient-to-r from-purple-600 to-indigo-500 text-white rounded-xl shadow-xl py-2 w-40 text-left z-50 origin-bottom group-hover:block hidden">
                <a href="{{ route('suppliers.create') }}" class="block px-4 py-2 hover:bg-purple-700 transition">📂 Datos</a>
                <a href="#" class="block px-4 py-2 hover:bg-purple-700 transition">📊 Reportes</a>
            </div>
        </div>

        <!-- Clientes -->
        <div class="relative group">
            <button class="flex flex-col items-center text-xs transition-transform duration-200 ease-out hover:scale-110 focus:outline-none">
                <i class="ph ph-users text-3xl"></i>
                <span class="text-[10px]">Clientes</span>
            </button>
            <div class="absolute bottom-full mb-2 bg-gradient-to-r from-purple-600 to-indigo-500 text-white rounded-xl shadow-xl py-2 w-40 text-left z-50 origin-bottom group-hover:block hidden">
                <a href="{{ route('customers.create') }}" class="block px-4 py-2 hover:bg-purple-700 transition">📂 Datos</a>
                <a href="#" class="block px-4 py-2 hover:bg-purple-700 transition">📊 Reportes</a>
            </div>
        </div>

        <!-- Productos -->
        <div class="relative group">
            <button class="flex flex-col items-center text-xs transition-transform duration-200 ease-out hover:scale-110 focus:outline-none">
                <i class="ph ph-package text-3xl"></i>
                <span class="text-[10px]">Productos</span>
            </button>
            <div class="absolute bottom-full mb-2 bg-gradient-to-r from-purple-600 to-indigo-500 text-white rounded-xl shadow-xl py-2 w-40 text-left z-50 origin-bottom group-hover:block hidden">
                <a href="{{ route('items.create') }}" class="block px-4 py-2 hover:bg-purple-700 transition">📂 Datos</a>
                <a href="#" class="block px-4 py-2 hover:bg-purple-700 transition">📊 Reportes</a>
            </div>
        </div>

        <!-- Ventas -->
        <div class="relative group">
            <button class="flex flex-col items-center text-xs transition-transform duration-200 ease-out hover:scale-110 focus:outline-none">
                <i class="ph ph-shopping-cart text-3xl"></i>
                <span class="text-[10px]">Ventas</span>
            </button>
            <div class="absolute bottom-full mb-2 bg-gradient-to-r from-purple-600 to-indigo-500 text-white rounded-xl shadow-xl py-2 w-40 text-left z-50 origin-bottom group-hover:block hidden">
                <a href="#" class="block px-4 py-2 hover:bg-purple-700 transition">📂 Datos</a>
                <a href="#" class="block px-4 py-2 hover:bg-purple-700 transition">📊 Reportes</a>
            </div>
        </div>

    </nav>

</body>
</html>
