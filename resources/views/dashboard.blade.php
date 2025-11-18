@extends('layouts.app') <!-- Or your user layout -->

@section('content')
<div class="max-w-7xl mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    <p>Welcome, {{ auth()->user()->name }}!</p>

    {{-- Example quick links --}}
    <div class="mt-4 space-x-4">
        <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Products</a>
        <a href="{{ route('custom_orders.index') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">My Custom Orders</a>
        <a href="{{ route('cart.index') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">My Cart</a>
    </div>
</div>
@endsection
