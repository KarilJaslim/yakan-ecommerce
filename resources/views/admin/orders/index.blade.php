@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-blue-600 text-white rounded-lg p-6 shadow">
            <h2 class="text-lg font-semibold">Total Orders</h2>
            <p class="text-2xl font-bold mt-2">{{ $totalOrders ?? 0 }}</p>
        </div>

        <div class="bg-yellow-500 text-white rounded-lg p-6 shadow">
            <h2 class="text-lg font-semibold">Pending Orders</h2>
            <p class="text-2xl font-bold mt-2">{{ $ordersByStatus['pending'] ?? 0 }}</p>
        </div>

        <div class="bg-green-600 text-white rounded-lg p-6 shadow">
            <h2 class="text-lg font-semibold">Completed Orders</h2>
            <p class="text-2xl font-bold mt-2">{{ $ordersByStatus['completed'] ?? 0 }}</p>
        </div>
    </div>

    <!-- Top Selling Products -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Top Selling Products</h2>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left">Product</th>
                        <th class="px-6 py-3 text-left">Sold</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topProducts as $product)
                        <tr class="border-b">
                            <td class="px-6 py-3">{{ $product->name }}</td>
                            <td class="px-6 py-3">{{ $product->order_items_sum_quantity ?? 0 }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-3 text-center text-gray-500">No products sold yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Orders Table -->
    <div>
        <h2 class="text-2xl font-semibold mb-4">All Orders</h2>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Order ID</th>
                        <th class="px-4 py-2">User</th>
                        <th class="px-4 py-2">Products</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Payment Status</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-b align-top">
                            <td class="px-4 py-2 font-medium">{{ $order->id }}</td>
                            <td class="px-4 py-2">{{ $order->user->name ?? 'Guest' }}</td>
                            <td class="px-4 py-2">
                                <ul class="list-disc ml-5">
                                    @foreach($order->items as $item)
                                        <li>
                                            {{ $item->product->name ?? 'Product Deleted' }} 
                                            x {{ $item->quantity }} 
                                            (₱{{ number_format($item->price, 2) }})
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-4 py-2 font-bold">₱{{ number_format($order->total, 2) }}</td>

                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-white
                                    {{ $order->status == 'pending' ? 'bg-yellow-500' : '' }}
                                    {{ $order->status == 'completed' ? 'bg-green-600' : '' }}
                                    {{ $order->status == 'cancelled' ? 'bg-red-600' : '' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-white
                                    {{ $order->payment_status == 'pending' ? 'bg-yellow-500' : '' }}
                                    {{ $order->payment_status == 'completed' ? 'bg-green-600' : '' }}
                                    {{ $order->payment_status == 'failed' ? 'bg-red-600' : '' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>

                            <td class="px-4 py-2">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-3 text-center text-gray-500">No orders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
