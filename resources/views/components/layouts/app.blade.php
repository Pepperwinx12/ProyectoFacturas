<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Invoicing System' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-blue-500 text-white px-4 py-3 flex justify-between items-center">
        <h1 class="text-xl font-bold">Invoicing System</h1>
        <div class="text-sm">Admin User</div>
    </header>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-64 p-4 space-y-4">
            <nav>
                <a href="/" class="block py-2 px-3 rounded hover:bg-gray-700">Home</a>
                <a href="/categories" class="block py-2 px-3 rounded hover:bg-gray-700">Categories</a>
                <a href="/products" class="block py-2 px-3 rounded hover:bg-gray-700">Products</a>
                <a href="/clients" class="block py-2 px-3 rounded hover:bg-gray-700">Clients</a>
                <a href="/sales" class="block py-2 px-3 rounded hover:bg-gray-700">Sales</a>
                <a href="/users" class="block py-2 px-3 rounded hover:bg-gray-700">Users</a>
            </nav>
        </aside>

        <main class="flex-1 p-6">
            @yield('content') <!-- Aquí se inyecta el contenido -->
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-200 text-center py-3 text-sm">
        Copyright @ 2014-2025 Administrative Solutions, S.A. - All rights reserved.
    </footer>

    @livewireScripts
</body>
</html>
