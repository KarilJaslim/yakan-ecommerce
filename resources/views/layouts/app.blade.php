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
        @include('layouts.navigation')

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
