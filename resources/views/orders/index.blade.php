@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Order Details</h1>
            <p class="text-gray-600">Order #{{ $order->id }}</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Order Items -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-200">
                        Order Items
                    </h2>

                    <div class="space-y-4">
                        @foreach($order->orderItems as $item)
                            <div class="flex items-center gap-4 py-4 border-b border-gray-100 last:border-0">
                                <!-- Product Image Placeholder -->
                                <div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-red-100 to-red-200 rounded-xl flex items-center justify-center">
                                    <svg class="w-10 h-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-1">{{ $item->product->name }}</h3>
                                    <div class="flex items-center gap-4 text-sm text-gray-600">
                                        <span>Qty: <span class="font-medium text-gray-900">{{ $item->quantity }}</span></span>
                                        <span class="text-gray-300">•</span>
                                        <span>₱{{ number_format($item->price, 2) }} each</span>
                                    </div>
                                </div>

                                <!-- Subtotal -->
                                <div class="text-right">
                                    <div class="text-lg font-bold text-gray-900">₱{{ number_format($item->price * $item->quantity, 2) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tracking Timeline -->
                @if($order->tracking_history)
                    @php
                        $trackingHistory = json_decode($order->tracking_history, true);
                    @endphp
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-200">
                            Order Tracking
                        </h2>

                        <div class="space-y-4">
                            @foreach($trackingHistory as $track)
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 w-3 h-3 rounded-full
                                        @if($track['status'] === $order->status)
                                            bg-red-600
                                        @else
                                            bg-gray-300
                                        @endif
                                    mt-1"></div>
                                    <div class="flex-1">
                                        <p class="text-gray-900 font-semibold">{{ $track['status'] }}</p>
                                        <p class="text-gray-600 text-sm">{{ $track['time'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 sticky top-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-200">
                        Order Summary
                    </h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Order ID:</span>
                            <span class="font-medium text-gray-900">#{{ $order->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date:</span>
                            <span class="font-medium text-gray-900">{{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Payment Method:</span>
                            <span class="font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Status:</span>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'processing' => 'bg-blue-100 text-blue-800',
                                    'shipped' => 'bg-purple-100 text-purple-800',
                                    'delivered' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $statusColor = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-3 py-1 {{ $statusColor }} rounded-lg text-sm font-medium">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-red-600">₱{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('shop.index') }}" class="block w-full text-center bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-3 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 font-semibold">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
