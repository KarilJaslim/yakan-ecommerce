@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <!-- Page Title + Button -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">My Custom Orders</h1>

        <a href="{{ route('custom_orders.create') }}"
           class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow transition transform hover:scale-105">
           + Create Custom Order
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->count() > 0)

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3 border-b">Order ID</th>
                        <th class="px-6 py-3 border-b">Product</th>
                        <th class="px-6 py-3 border-b">Quantity</th>
                        <th class="px-6 py-3 border-b">Status</th>
                        <th class="px-6 py-3 border-b">Payment</th>
                        <th class="px-6 py-3 border-b">Created At</th>
                        <th class="px-6 py-3 border-b">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3 border-b font-semibold text-gray-700">#{{ $order->id }}</td>
                        <td class="px-6 py-3 border-b">{{ $order->product->name ?? 'N/A' }}</td>
                        <td class="px-6 py-3 border-b">{{ $order->quantity }}</td>

                        <!-- Status Badge -->
                        <td class="px-6 py-3 border-b">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'in_progress' => 'bg-blue-100 text-blue-700',
                                    'completed' => 'bg-green-100 text-green-700',
                                    'cancelled' => 'bg-red-100 text-red-700'
                                ];
                            @endphp
                            <span class="px-2 py-1 text-sm rounded font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </td>

                        <!-- Payment Status Badge -->
                        <td class="px-6 py-3 border-b">
                            @php
                                $payColors = [
                                    'unpaid' => 'bg-red-100 text-red-700',
                                    'paid' => 'bg-green-100 text-green-700'
                                ];
                            @endphp
                            <span class="px-2 py-1 text-sm rounded font-medium {{ $payColors[$order->payment_status] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>

                        <td class="px-6 py-3 border-b text-gray-600">{{ $order->created_at->format('M d, Y') }}</td>

                        <td class="px-6 py-3 border-b">
                            <a href="{{ route('custom_orders.show', $order->id) }}"
                               class="text-blue-600 hover:underline mr-2">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $orders->links() }}
        </div>

    @else
        <!-- Empty State -->
        <div class="bg-white p-10 rounded-lg shadow text-center mt-10">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">No Custom Orders Yet</h2>
            <p class="text-gray-500 mb-4">Create a custom product order tailored to your requirements.</p>
            <a href="{{ route('custom_orders.create') }}"
               class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg shadow transition transform hover:scale-105">
               Create Custom Order
            </a>
        </div>
    @endif

</div>
@endsection
