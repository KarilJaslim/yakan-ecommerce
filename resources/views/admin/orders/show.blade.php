@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Order #{{ $order->id }}</h1>

    <!-- Order Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
            <p><strong>User:</strong> {{ $order->user->name ?? 'Guest' }}</p>
            <p>
                <strong>Status:</strong> 
                <span class="px-2 py-1 rounded-full text-white
                    {{ $order->status == 'pending' ? 'bg-yellow-500' : '' }}
                    {{ $order->status == 'processing' ? 'bg-blue-500' : '' }}
                    {{ $order->status == 'completed' ? 'bg-green-600' : '' }}
                    {{ $order->status == 'cancelled' ? 'bg-red-600' : '' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p>
                <strong>Payment Status:</strong> 
                <span class="px-2 py-1 rounded-full text-white
                    {{ $order->payment_status == 'pending' ? 'bg-yellow-500' : '' }}
                    {{ $order->payment_status == 'completed' ? 'bg-green-600' : '' }}
                    {{ $order->payment_status == 'failed' ? 'bg-red-600' : '' }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </p>
        </div>
        <div>
            <p><strong>Total:</strong> ₱{{ number_format($order->total, 2) }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y, g:i a') }}</p>
        </div>
    </div>

    <!-- Items Table -->
    <h2 class="text-2xl font-semibold mb-4">Items</h2>
    <div class="overflow-x-auto mb-6">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">Product</th>
                    <th class="px-6 py-3 text-left">Price (₱)</th>
                    <th class="px-6 py-3 text-left">Quantity</th>
                    <th class="px-6 py-3 text-left">Subtotal (₱)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($order->items as $item)
                <tr class="border-b">
                    <td class="px-6 py-3">{{ $item->product->name ?? 'Deleted Product' }}</td>
                    <td class="px-6 py-3">{{ number_format($item->price, 2) }}</td>
                    <td class="px-6 py-3">{{ $item->quantity }}</td>
                    <td class="px-6 py-3">{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-3 text-center text-gray-500">No items found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Update Status Form -->
    <h2 class="text-2xl font-semibold mb-4">Update Status</h2>
    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium mb-1">Order Status</label>
            <select name="status" class="form-control w-1/2 px-3 py-2 border rounded-lg">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Payment Status</label>
            <select name="payment_status" class="form-control w-1/2 px-3 py-2 border rounded-lg">
                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->payment_status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Update Status</button>
    </form>

    <a href="{{ route('admin.orders.index') }}" class="inline-block mt-4 bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Back to Orders</a>
</div>
@endsection
