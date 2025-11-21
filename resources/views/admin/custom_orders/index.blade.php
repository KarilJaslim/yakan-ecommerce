@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">📦 My Custom Orders</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->count() == 0)
        <p class="text-gray-600">You have no custom orders yet.</p>
        <a href="{{ route('custom_orders.create') }}" class="text-red-600 hover:underline mt-2 inline-block">Create your first order</a>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($orders as $order)
                <div class="bg-white shadow rounded-lg p-4 hover:scale-105 transform transition">
                    <img src="{{ asset('storage/' . $order->product->image) }}" 
                         class="w-full h-48 object-cover rounded-md">

                    <h2 class="text-xl font-semibold mt-3">{{ $order->product->name }}</h2>
                    <p class="text-gray-600 text-sm">{{ Str::limit($order->product->description, 60) }}</p>

                    <p class="text-gray-700 mt-2">Quantity: {{ $order->quantity }}</p>
                    <p class="text-gray-700">Status: <span class="font-bold">{{ ucfirst($order->status) }}</span></p>
                    <p class="text-gray-700">Payment: <span class="font-bold">{{ ucfirst($order->payment_status) }}</span></p>

                    <a href="{{ route('custom_orders.show', $order->id) }}"
                       class="block mt-3 bg-red-600 text-white text-center py-2 rounded hover:bg-red-700">
                        View Details
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
