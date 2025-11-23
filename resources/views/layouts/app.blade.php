<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')

    <style>
        /* Smooth UI transitions */
        * {
            transition: all .2s ease-in-out;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-800">
    <!-- Background gradient -->
    <div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200">

        <!-- Navigation -->
        <nav class="bg-white shadow-md border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ url('/') }}" class="text-xl font-bold text-gray-900">{{ config('app.name', 'Laravel') }}</a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="flex space-x-4 items-center">
                        <a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Home</a>
                        <a href="{{ route('shop.index') }}" class="text-gray-700 hover:text-gray-900">Shop</a>

                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-gray-900">Dashboard</a>
                                <a href="{{ route('admin.orders.index') }}" class="text-gray-700 hover:text-gray-900">Orders</a>
                                <a href="{{ route('admin.products.index') }}" class="text-gray-700 hover:text-gray-900">Products</a>
                            @else
                                <a href="{{ route('orders.index') }}" class="text-gray-700 hover:text-gray-900">My Orders</a>
                                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-gray-900">Cart</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-gray-900">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Login</a>
                            <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-sm border-b">
                <div class="max-w-7xl mx-auto py-6 px-6 lg:px-8">
                    <h1 class="text-2xl font-semibold text-gray-900">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 border border-gray-100">
                @yield('content')
            </div>
        </main>

    </div>

    @stack('scripts')
</body>
</html>
