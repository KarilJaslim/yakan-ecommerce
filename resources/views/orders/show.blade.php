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
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Order Confirmation</h1>
            <p class="text-gray-600">Thank you for your order! Track your order status below.</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Order Items + Timeline -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Order Items -->
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

                <!-- Payment Status Info -->
                @if($order->payment_method === 'online' || $order->payment_method === 'bank_transfer')
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                        <div class="flex gap-3">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-blue-900 mb-2">Payment Status</h3>
                                <p class="text-sm text-blue-700">
                                    @if($order->payment_method === 'online')
                                        Your GCash payment is being verified. We'll process your order once confirmed.
                                    @else
                                        Your bank transfer payment is being verified. We'll process your order once confirmed.
                                    @endif
                                </p>
                                <p class="text-sm text-blue-700 mt-2">
                                    Expected verification time: <span class="font-semibold">5-10 minutes during business hours</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Tracking Timeline -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-200">Order Tracking</h2>
                    <div class="relative border-l border-gray-200">
                        @php
                            $trackingColors = [
                                'Order Placed' => 'bg-yellow-500',
                                'Processing' => 'bg-blue-500',
                                'Shipped' => 'bg-purple-500',
                                'Delivered' => 'bg-green-500',
                                'Cancelled' => 'bg-red-500',
                            ];
                        @endphp
                        @foreach($order->tracking_history ?? [] as $history)
                            @php
                                $color = $trackingColors[$history['status']] ?? 'bg-gray-500';
                            @endphp
                            <div class="mb-10 ml-6">
                                <span class="absolute -left-3 flex items-center justify-center w-6 h-6 {{ $color }} rounded-full ring-8 ring-white"></span>
                                <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">{{ $history['status'] }}</h3>
                                <time class="block mb-2 text-sm font-normal text-gray-400">{{ $history['date'] }}</time>
                            </div>
                        @endforeach
                        @if(empty($order->tracking_history))
                            <p class="text-gray-500">Tracking history is not yet available.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
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
                            <span class="text-gray-600">Time:</span>
                            <span class="font-medium text-gray-900">{{ $order->created_at->format('h:i A') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Payment Method:</span>
                            <span class="font-medium text-gray-900">
                                @if($order->payment_method === 'online')
                                    GCash
                                @elseif($order->payment_method === 'bank_transfer')
                                    Bank Transfer
                                @else
                                    {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                                @endif
                            </span>
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

                    <div class="border-t border-gray-200 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total Amount</span>
                            <span class="text-2xl font-bold text-red-600">₱{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('shop.index') }}" 
                           class="block w-full text-center bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-3 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 transform hover:scale-105 shadow-lg font-semibold">
                            Continue Shopping
                        </a>
                        
                        <a href="{{ route('dashboard') }}" 
                           class="block w-full text-center text-gray-700 hover:text-red-600 px-6 py-3 rounded-xl border-2 border-gray-200 hover:border-red-600 transition-all duration-200 font-medium">
                            Go to Dashboard
                        </a>
                    </div>

                    <!-- Contact Support -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="text-center text-sm text-gray-600">
                            <p class="mb-2">Need help with your order?</p>
                            <a href="#" class="text-red-600 hover:text-red-700 font-medium">Contact Support</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
