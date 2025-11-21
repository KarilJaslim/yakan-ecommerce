<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-red-600 text-white p-6 flex flex-col">
        <h2 class="text-2xl font-bold mb-8">Admin</h2>
        <nav class="flex flex-col space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:bg-red-700 p-2 rounded">Dashboard</a>
            <a href="{{ route('admin.orders.index') }}" class="hover:bg-red-700 p-2 rounded">Orders</a>
            <a href="{{ route('admin.products.index') }}" class="hover:bg-red-700 p-2 rounded">Products</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-4 hover:bg-red-700 p-2 rounded w-full text-left">Logout</button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-auto">
        <header class="mb-6">
            <h1 class="text-3xl font-bold">Admin Dashboard</h1>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

</body>
</html>
