@extends('layouts.app') {{-- or your user layout --}}

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Custom Order Details</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-6 mb-6">
        <h2 class="text-xl font-semibold mb-2">Order #{{ $order->id }}</h2>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
        <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
        <p><strong>Product:</strong> {{ $order->product->name ?? 'N/A' }}</p>
        <p><strong>Specifications:</strong> {{ $order->specifications ?? 'None' }}</p>
        <p><strong>Created At:</strong> {{ $order->created_at->format('F d, Y H:i') }}</p>

        @if($order->design_upload)
            <div class="mt-4">
                <p><strong>Design Upload:</strong></p>
                <img src="{{ asset('storage/' . $order->design_upload) }}" alt="Design Upload" class="max-w-xs rounded shadow">
            </div>
        @endif
    </div>

    <a href="{{ route('custom_orders.index') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Back to My Orders
    </a>
</div>
@endsection
