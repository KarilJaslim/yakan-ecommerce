@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2 flex items-center gap-3">
                <span class="text-red-600">🛒</span>
                Shopping Cart
            </h1>
            <p class="text-gray-600">Review your items before checkout</p>
        </div>

        @if($cartItems->isEmpty())
            <!-- Empty Cart State -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="mb-6">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Your cart is empty</h3>
                <p class="text-gray-600 mb-8">Looks like you haven't added any items yet</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-red-600 text-white px-8 py-3 rounded-xl hover:bg-red-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <span>Continue Shopping</span>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        @else
            @php $total = 0; @endphp
            
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Cart Items Section -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $item)
                        @php
                            $subtotal = $item->quantity * $item->product->price;
                            $total += $subtotal;
                        @endphp
                        
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border border-gray-100">
                            <div class="flex items-center gap-6">
                                <!-- Product Image Placeholder -->
                                <div class="flex-shrink-0 w-24 h-24 bg-gradient-to-br from-red-100 to-red-200 rounded-xl flex items-center justify-center">
                                    <svg class="w-12 h-12 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $item->product->name }}</h3>
                                    <div class="flex items-center gap-6 text-sm">
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-500">Qty:</span>
                                            <span class="bg-gray-100 px-3 py-1 rounded-lg font-medium text-gray-900">{{ $item->quantity }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-500">Price:</span>
                                            <span class="font-medium text-gray-900">₱{{ number_format($item->product->price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Subtotal & Actions -->
                                <div class="flex flex-col items-end gap-3">
                                    <div class="text-right">
                                        <div class="text-xs text-gray-500 mb-1">Subtotal</div>
                                        <div class="text-xl font-bold text-red-600">₱{{ number_format($subtotal, 2) }}</div>
                                    </div>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2 text-red-600 hover:text-white hover:bg-red-600 px-4 py-2 rounded-lg transition-all duration-200 border border-red-200 hover:border-red-600">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <span class="font-medium">Remove</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-6 border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-200">Order Summary</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Items ({{ $cartItems->count() }})</span>
                                <span class="font-medium">₱{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="font-medium text-green-600">FREE</span>
                            </div>
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-900">Total</span>
                                    <span class="text-2xl font-bold text-red-600">₱{{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('cart.checkout') }}" class="block w-full bg-gradient-to-r from-red-600 to-red-700 text-white text-center px-6 py-4 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold mb-3">
                            Proceed to Checkout
                        </a>
                        
                        <a href="{{ route('products.index') }}" class="block w-full text-center text-gray-700 hover:text-red-600 px-6 py-3 rounded-xl border-2 border-gray-200 hover:border-red-600 transition-all duration-200 font-medium">
                            Continue Shopping
                        </a>

                        <!-- Trust Badges -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="flex items-center gap-3 text-sm text-gray-600 mb-2">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Secure Checkout</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                                </svg>
                                <span>Fast Delivery</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection