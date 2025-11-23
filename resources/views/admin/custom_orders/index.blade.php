@extends('layouts.admin') {{-- Only extend admin layout for admin view --}}
@section('content')
<div class="max-w-6xl mx-auto p-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Custom Orders</h1>
        <a href="{{ route('custom_orders.create') }}"
           class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow transition">
            + Create Custom Order
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Orders Grid --}}
    @if($orders->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($orders as $order)
                <a href="{{ route('admin.custom_orders.show', $order->id) }}" {{-- Fixed admin route --}}
                   class="block border rounded-lg shadow-sm p-4 bg-white hover:shadow-lg transition duration-200">

                    {{-- Image --}}
                    @if ($order->design_upload)
                        <img src="{{ asset('storage/' . $order->design_upload) }}"
                             class="w-full h-48 object-cover rounded-lg mb-4">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                            <span class="text-gray-500">No Design Uploaded</span>
                        </div>
                    @endif

                    {{-- Order Info --}}
                    <h2 class="text-xl font-semibold mb-2">Order #{{ $order->id }}</h2>
                    <p class="text-gray-700 mb-2">
                        <strong>Specifications:</strong><br>
                        {{ $order->specifications }}
                    </p>
                    <p class="text-gray-700 mb-2">
                        <strong>Quantity:</strong> {{ $order->quantity }}
                    </p>

                    {{-- Status Badge --}}
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-500',
                            'in_progress' => 'bg-blue-500',
                            'completed' => 'bg-green-600',
                            'cancelled' => 'bg-red-600'
                        ];
                        $color = $statusColors[$order->status] ?? 'bg-gray-500';
                    @endphp
                    <span class="px-3 py-1 text-white rounded inline-block mt-2 {{ $color }}">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>

                </a>
            @endforeach

        </div>

        {{-- Pagination --}}
        <div class="mt-6 flex justify-center">
            {{ $orders->links() }}
        </div>

    @else
        {{-- Empty State --}}
        <div class="bg-white p-10 rounded-lg shadow text-center mt-10">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">No Custom Orders Yet</h2>
            <p class="text-gray-500 mb-4">No custom product orders have been created yet.</p>
        </div>
    @endif

</div>
@endsection
