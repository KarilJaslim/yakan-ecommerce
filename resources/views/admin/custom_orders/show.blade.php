@extends('layouts.admin')
@section('content')
<div class="container mx-auto py-6">

    <a href="{{ route('admin.custom_orders.index') }}" {{-- Fixed admin route --}}
       class="mb-4 inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
       ← Back to Custom Orders
    </a>

    <div class="bg-white shadow rounded-lg p-6">

        <h1 class="text-2xl font-bold mb-4">Custom Order #{{ $order->id }}</h1>

        {{-- Order Info --}}
        <p><strong>Specifications:</strong> {{ $order->specifications }}</p>
        <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
        <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $order->status)) }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
        <p><strong>Created At:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>

        {{-- Design Upload --}}
        <div class="mt-4">
            <h2 class="text-lg font-semibold mb-2">Design</h2>
            @if($order->design_upload)
                <img src="{{ asset('storage/' . $order->design_upload) }}"
                     alt="Design"
                     class="w-64 h-64 object-cover rounded-lg shadow">
            @else
                <div class="w-64 h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                    <span class="text-gray-500">No Design Uploaded</span>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
