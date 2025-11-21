@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6">

    {{-- Back Button --}}
    <a href="{{ route('admin.custom_orders.index') }}"
       class="mb-4 inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
       ← Back to Custom Orders
    </a>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">

        <h1 class="text-2xl font-bold mb-4">Custom Order #{{ $order->id }}</h1>

        {{-- User Info --}}
        <p><strong>User:</strong> {{ $order->user->name ?? 'N/A' }} ({{ $order->user->email ?? 'N/A' }})</p>

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
                <a href="{{ asset('storage/' . $order->design_upload) }}" target="_blank">
                    <img src="{{ asset('storage/' . $order->design_upload) }}"
                         alt="Design"
                         class="w-64 h-64 object-cover rounded-lg shadow">
                </a>
            @else
                <div class="w-64 h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                    <span class="text-gray-500">No Design Uploaded</span>
                </div>
            @endif
        </div>

        {{-- Update Status Form --}}
        <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-2">Update Status</h2>
            <form action="{{ route('admin.custom_orders.update_status', $order->id) }}" method="POST" class="flex gap-2 items-center">
                @csrf
                <select name="status" class="border rounded px-2 py-1">
                    <option value="pending" @selected($order->status === 'pending')>Pending</option>
                    <option value="processing" @selected($order->status === 'processing')>Processing</option>
                    <option value="completed" @selected($order->status === 'completed')>Completed</option>
                    <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    Update
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
