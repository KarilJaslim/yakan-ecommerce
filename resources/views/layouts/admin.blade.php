<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="font-bold">Dashboard</a>
            <a href="{{ route('admin.orders.index') }}" class="ml-4">Orders</a>
        </div>
        <div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="hover:underline text-red-600">Logout</button>
            </form>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>

</body>
</html>
