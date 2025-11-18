@extends('layouts.admin')
@section('title', 'Orders')

@section('content')
<div class="container mx-auto py-6">

    <!-- Search & Filter -->
    <div class="flex justify-between mb-4">
        <input type="text" id="user-search" placeholder="Search by user" class="border rounded px-3 py-1">
        <select id="status-filter" class="border rounded px-3 py-1">
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="processing">Processing</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    <!-- Orders Table -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200" id="orders-table">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4">Order ID</th>
                    <th class="py-3 px-4">User</th>
                    <th class="py-3 px-4">Products</th>
                    <th class="py-3 px-4">Total</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Payment Status</th>
                    <th class="py-3 px-4">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($orders as $order)
                <tr class="hover:bg-gray-100">
                    <td class="py-3 px-4">{{ $order->id }}</td>
                    <td class="py-3 px-4">{{ $order->user->name ?? 'Guest' }}</td>
                    <td class="py-3 px-4">
                        @foreach($order->items as $item)
                            {{ $item->product->name }} x {{ $item->quantity }} (₱{{ number_format($item->price, 2) }})<br>
                        @endforeach
                    </td>
                    <td class="py-3 px-4">₱{{ number_format($order->total, 2) }}</td>

                    <!-- Status -->
                    <td class="py-3 px-4">
                        <form action="{{ route('admin.orders.quickUpdateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="border rounded px-2 py-1 w-full" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
                                <option value="processing" {{ $order->status=='processing'?'selected':'' }}>Processing</option>
                                <option value="completed" {{ $order->status=='completed'?'selected':'' }}>Completed</option>
                                <option value="cancelled" {{ $order->status=='cancelled'?'selected':'' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>

                    <!-- Payment Status -->
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 rounded
                            @if($order->payment_status=='paid') bg-green-600 text-white
                            @elseif($order->payment_status=='pending') bg-yellow-500 text-white
                            @elseif($order->payment_status=='refunded') bg-purple-600 text-white
                            @else bg-red-600 text-white @endif">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </td>

                    <!-- Actions -->
                    <td class="py-3 px-4 flex space-x-2">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                            View
                        </a>

                        @if ($order->payment_status === 'paid' && $order->status !== 'cancelled')
                        <form action="{{ route('admin.orders.refund', $order->id) }}" method="POST" onsubmit="return confirm('Refund this order?');">
                            @csrf
                            @method('PUT')
                            <button class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700">
                                Refund
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<!-- jQuery for AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function fetchOrders() {
    let status = $('#status-filter').val();
    let user = $('#user-search').val();

    $.get("{{ route('admin.orders.index') }}", { status: status, user: user }, function(data) {
        $('#orders-table tbody').html(data);
    });
}

$('#status-filter, #user-search').on('change keyup', fetchOrders);
</script>
@endsection
