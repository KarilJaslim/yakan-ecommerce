@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">

        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('custom_orders.index') }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="font-medium">Back to My Orders</span>
            </a>
        </div>

        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Order Details</h1>
                    <p class="text-gray-600">Order #{{ $order->id }}</p>
                </div>
                <div class="flex items-center gap-3">
                    @php
                        $statusConfig = [
                            'pending' => [
                                'bg' => 'bg-yellow-100',
                                'text' => 'text-yellow-800',
                                'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
                            ],
                            'in_progress' => [
                                'bg' => 'bg-blue-100',
                                'text' => 'text-blue-800',
                                'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'
                            ],
                            'completed' => [
                                'bg' => 'bg-green-100',
                                'text' => 'text-green-800',
                                'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
                            ],
                            'cancelled' => [
                                'bg' => 'bg-red-100',
                                'text' => 'text-red-800',
                                'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'
                            ]
                        ];
                        $config = $statusConfig[$order->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'icon' => ''];
                    @endphp
                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold {{ $config['bg'] }} {{ $config['text'] }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"/>
                        </svg>
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm animate-fade-in">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Product Information Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            Product Information
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500 mb-1">Product Name</p>
                                <p class="text-lg font-bold text-gray-900">{{ $order->product->name ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-500 mb-1">Quantity</p>
                                    <p class="text-lg font-bold text-gray-900">{{ $order->quantity }} units</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specifications Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Specifications
                        </h2>
                    </div>
                    <div class="p-6">
                        @if($order->specifications)
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $order->specifications }}</p>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-gray-500 font-medium">No specifications provided</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Design Upload Card -->
                @if($order->design_upload)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Design Upload
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $order->design_upload) }}" 
                                 alt="Design Upload" 
                                 class="w-full rounded-xl shadow-lg border-2 border-gray-200 transition-transform duration-300 group-hover:scale-[1.02]">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300 rounded-xl flex items-center justify-center">
                                <a href="{{ asset('storage/' . $order->design_upload) }}" 
                                   target="_blank"
                                   class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white text-gray-900 px-4 py-2 rounded-lg shadow-lg font-medium inline-flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                    </svg>
                                    View Full Size
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                
                <!-- Order Summary Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden sticky top-6">
                    <div class="bg-gradient-to-r from-gray-700 to-gray-800 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Order Summary
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        
                        <!-- Order ID -->
                        <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                            <span class="text-sm font-medium text-gray-600">Order ID</span>
                            <span class="text-sm font-bold text-gray-900">#{{ $order->id }}</span>
                        </div>

                        <!-- Status -->
                        <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                            <span class="text-sm font-medium text-gray-600">Order Status</span>
                            @php
                                $statusConfig = [
                                    'pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800'],
                                    'in_progress' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800'],
                                    'completed' => ['bg' => 'bg-green-100', 'text' => 'text-green-800'],
                                    'cancelled' => ['bg' => 'bg-red-100', 'text' => 'text-red-800']
                                ];
                                $config = $statusConfig[$order->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800'];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $config['bg'] }} {{ $config['text'] }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>

                        <!-- Payment Status -->
                        <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                            <span class="text-sm font-medium text-gray-600">Payment</span>
                            @php
                                $paymentConfig = [
                                    'unpaid' => ['bg' => 'bg-red-100', 'text' => 'text-red-800'],
                                    'paid' => ['bg' => 'bg-green-100', 'text' => 'text-green-800']
                                ];
                                $payConfig = $paymentConfig[$order->payment_status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800'];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $payConfig['bg'] }} {{ $payConfig['text'] }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>

                        <!-- Created Date -->
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Created</span>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-900">{{ $order->created_at->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $order->created_at->format('h:i A') }}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Status Timeline -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Order Timeline
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @php
                                $statuses = ['pending', 'in_progress', 'completed'];
                                $currentIndex = array_search($order->status, $statuses);
                                if ($currentIndex === false) $currentIndex = -1;
                            @endphp

                            @foreach(['pending' => 'Order Placed', 'in_progress' => 'In Progress', 'completed' => 'Completed'] as $status => $label)
                                @php
                                    $statusIndex = array_search($status, $statuses);
                                    $isActive = $statusIndex <= $currentIndex;
                                    $isCurrent = $status === $order->status;
                                @endphp
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $isActive ? 'bg-green-500' : 'bg-gray-300' }}">
                                            @if($isActive)
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            @else
                                                <div class="w-3 h-3 bg-white rounded-full"></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold {{ $isActive ? 'text-gray-900' : 'text-gray-500' }}">{{ $label }}</p>
                                        @if($isCurrent)
                                            <p class="text-xs text-green-600 font-medium mt-0.5">Current Status</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex flex-col sm:flex-row gap-4">
            <a href="{{ route('custom_orders.index') }}" 
               class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-white border-2 border-gray-300 hover:border-gray-400 text-gray-700 font-semibold rounded-xl shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Orders
            </a>
            @if($order->design_upload)
            <a href="{{ asset('storage/' . $order->design_upload) }}" 
               download
               class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Download Design
            </a>
            @endif
        </div>

    </div>
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}
</style>
@endsection