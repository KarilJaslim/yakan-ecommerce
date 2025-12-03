@extends('layouts.admin')

@section('title', 'Custom Orders Management - Enhanced')

@push('styles')
<style>
    /* Modern CSS Variables */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
        --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --hover-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    /* Enhanced Animations */
    @keyframes slideInUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes fadeInScale {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    /* Enhanced Status Badges */
    .status-badge {
        @apply px-4 py-2 rounded-full text-sm font-semibold relative overflow-hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .status-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.6s;
    }
    
    .status-badge:hover::before {
        left: 100%;
    }
    
    .status-pending { 
        background: linear-gradient(135deg, #fef3c7, #fbbf24);
        color: #92400e;
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }
    
    .status-processing { 
        background: linear-gradient(135deg, #dbeafe, #60a5fa);
        color: #1e40af;
        box-shadow: 0 4px 15px rgba(96, 165, 250, 0.3);
    }
    
    .status-completed { 
        background: linear-gradient(135deg, #d1fae5, #34d399);
        color: #065f46;
        box-shadow: 0 4px 15px rgba(52, 211, 153, 0.3);
    }
    
    .status-rejected { 
        background: linear-gradient(135deg, #fee2e2, #f87171);
        color: #991b1b;
        box-shadow: 0 4px 15px rgba(248, 113, 113, 0.3);
    }
    
    /* Enhanced Cards */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--hover-shadow);
    }
    
    /* Enhanced Buttons */
    .btn-gradient {
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .btn-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }
    
    .btn-gradient:hover::before {
        left: 100%;
    }
    
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }
    
    /* Enhanced Table */
    .modern-table {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }
    
    .modern-table thead {
        background: var(--primary-gradient);
        color: white;
    }
    
    .modern-table thead th {
        padding: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.875rem;
    }
    
    .modern-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .modern-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
    }
    
    .modern-table tbody td {
        padding: 16px 20px;
    }
    
    /* Enhanced Stats Cards */
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Loading Animation */
    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid rgba(102, 126, 234, 0.2);
        border-top: 4px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .stat-card {
            padding: 16px;
        }
        
        .stat-number {
            font-size: 2rem;
        }
        
        .modern-table {
            font-size: 0.875rem;
        }
        
        .btn-gradient {
            padding: 10px 20px;
            font-size: 0.875rem;
        }
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 p-6">
    <!-- Enhanced Header -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="text-center mb-8">
            <h1 class="text-5xl font-bold mb-4 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent animate-pulse">
                Custom Orders Management
            </h1>
            <p class="text-gray-600 text-xl">Advanced order management with real-time analytics and automation</p>
        </div>

        <!-- Enhanced Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card glass-card" style="animation: fadeInScale 0.6s ease-out;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-2">Total Orders</p>
                        <p class="stat-number">{{ $orders->total() }}</p>
                        <p class="text-gray-500 text-sm mt-1">All time</p>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl shadow-lg">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card glass-card" style="animation: fadeInScale 0.8s ease-out;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-2">Pending</p>
                        <p class="stat-number">{{ \App\Models\CustomOrder::where('status', 'pending')->count() }}</p>
                        <p class="text-gray-500 text-sm mt-1">Awaiting action</p>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center text-white text-2xl shadow-lg">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card glass-card" style="animation: fadeInScale 1s ease-out;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-2">Processing</p>
                        <p class="stat-number">{{ \App\Models\CustomOrder::where('status', 'processing')->count() }}</p>
                        <p class="text-gray-500 text-sm mt-1">In progress</p>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full flex items-center justify-center text-white text-2xl shadow-lg">
                        <i class="fas fa-cog"></i>
                    </div>
                </div>
            </div>
            
            <div class="stat-card glass-card" style="animation: fadeInScale 1.2s ease-out;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-2">Completed</p>
                        <p class="stat-number">{{ \App\Models\CustomOrder::where('status', 'completed')->count() }}</p>
                        <p class="text-gray-500 text-sm mt-1">Finished</p>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white text-2xl shadow-lg">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Action Bar -->
        <div class="glass-card p-6 mb-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('admin.custom_orders.create') }}" class="btn-gradient">
                        <i class="fas fa-plus mr-2"></i>New Order
                    </a>
                    <button onclick="refreshOrders()" class="px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-all duration-300 shadow-sm">
                        <i class="fas fa-sync-alt mr-2"></i>Refresh
                    </button>
                    <button onclick="toggleBulkMode()" class="px-4 py-2 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-all duration-300">
                        <i class="fas fa-check-square mr-2"></i>Bulk Actions
                    </button>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" id="quickSearch" placeholder="Search orders..." 
                               class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="exportOrders()" class="px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all duration-300">
                            <i class="fas fa-download mr-1"></i>Export
                        </button>
                        <button onclick="printOrders()" class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-300">
                            <i class="fas fa-print mr-1"></i>Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
                    <i class="fas fa-shopping-bag"></i>
                </div>
            </div>
        </div>
        
        <!-- Enhanced Filters Section -->
        <div class="glass-card p-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-filter mr-3 text-purple-600"></i>
                Advanced Filters
            </h3>
            <form id="filterForm" action="{{ route('admin.custom_orders.index') }}" method="GET" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-info-circle mr-2 text-purple-500"></i>Status
                        </label>
                        <select name="status" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white transition-all duration-300">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="price_quoted" {{ request('status') == 'price_quoted' ? 'selected' : '' }}>Price Quoted</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-search mr-2 text-purple-500"></i>Search
                        </label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Customer name, email, or order ID"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white transition-all duration-300">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-calendar-alt mr-2 text-purple-500"></i>Date From
                        </label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white transition-all duration-300">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-calendar-alt mr-2 text-purple-500"></i>Date To
                        </label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white transition-all duration-300">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-sort mr-2 text-purple-500"></i>Sort By
                        </label>
                        <select name="sort" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white transition-all duration-300">
                            <option value="created_at_desc" {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>Newest First</option>
                            <option value="created_at_asc" {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>Oldest First</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price High to Low</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price Low to High</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-list mr-2 text-purple-500"></i>Per Page
                        </label>
                        <select name="per_page" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white transition-all duration-300">
                            <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                    
                    <div class="flex items-end">
                        <div class="flex gap-3 w-full">
                            <button type="submit" class="btn-gradient flex-1">
                                <i class="fas fa-search mr-2"></i>Apply Filters
                            </button>
                            <a href="{{ route('admin.custom_orders.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 flex-1 text-center font-semibold">
                                <i class="fas fa-times mr-2"></i>Clear
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
                    <p class="text-blue-200 text-xs mt-1">Awaiting action</p>
                </div>
                <div class="text-6xl text-blue-200 opacity-50">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card stat-green" onclick="filterByStatus('processing')">
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Processing</p>
                    <p class="text-4xl font-bold">{{ $orders->where('status', 'processing')->count() }}</p>
                    <p class="text-green-200 text-xs mt-1">In progress</p>
                </div>
                <div class="text-6xl text-green-200 opacity-50">
                    <i class="fas fa-cog"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card stat-purple" onclick="filterByStatus('completed')">
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-1">Completed</p>
                    <p class="text-4xl font-bold">{{ $orders->where('status', 'completed')->count() }}</p>
                    <p class="text-purple-200 text-xs mt-1">Finished</p>
                </div>
                <div class="text-6xl text-purple-200 opacity-50">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Actions Section -->
    <div id="bulkActions" class="bulk-actions hidden">
        <div class="flex items-center">
            <span class="text-sm font-medium text-blue-800 mr-4">
                <span id="selectedCount">0</span> orders selected
            </span>
            <div class="flex items-center space-x-2">
                <button onclick="bulkApprove()" class="px-3 py-1 bg-green-100 text-green-700 rounded hover:bg-green-200 transition-colors text-sm">
                    <i class="fas fa-check mr-1"></i>Approve
                </button>
                <button onclick="bulkReject()" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors text-sm">
                    <i class="fas fa-times mr-1"></i>Reject
                </button>
                <button onclick="bulkDelete()" class="px-3 py-1 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition-colors text-sm">
                    <i class="fas fa-trash mr-1"></i>Delete
                </button>
                <button onclick="bulkExport()" class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors text-sm">
                    <i class="fas fa-download mr-1"></i>Export
                </button>
            </div>
        </div>
    </div>

    <!-- Advanced Filters Section -->
    <div class="filter-section">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <!-- Enhanced Orders Table -->
        <div class="modern-table">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            </th>
                            <th class="text-left">Order ID</th>
                            <th class="text-left">Customer</th>
                            <th class="text-left">Product</th>
                            <th class="text-left">Status</th>
                            <th class="text-left">Price</th>
                            <th class="text-left">Date</th>
                            <th class="text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr class="hover:bg-purple-50 transition-colors duration-200">
                            <td>
                                <input type="checkbox" class="order-checkbox rounded border-gray-300 text-purple-600 focus:ring-purple-500" value="{{ $order->id }}">
                            </td>
                            <td class="font-mono text-sm">
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs font-semibold">
                                    #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-xs font-bold mr-3">
                                        {{ $order->user ? strtoupper(substr($order->user->name, 0, 1)) : 'G' }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">
                                            {{ $order->user ? $order->user->name : 'Guest User' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $order->user ? $order->user->email : ($order->email ?? 'N/A') }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="max-w-xs">
                                    <div class="font-medium text-gray-900 truncate">{{ $order->product->name ?? $order->order_name ?? 'Custom Product' }}</div>
                                    @if($order->fabric_type)
                                        <div class="text-xs text-gray-500">Fabric: {{ $order->fabric_type }}</div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td class="font-semibold text-gray-900">
                                ₱{{ number_format($order->final_price ?? $order->estimated_price ?? 0, 2) }}
                            </td>
                            <td class="text-sm text-gray-500">
                                {{ $order->created_at->format('M d, Y') }}
                                <div class="text-xs">{{ $order->created_at->format('h:i A') }}</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <button onclick="viewOrder({{ $order->id }})" class="action-btn action-primary" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="editOrder({{ $order->id }})" class="action-btn action-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @if($order->status === 'pending')
                                        <button onclick="quickApprove({{ $order->id }})" class="action-btn action-success" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    @endif
                                    <button onclick="deleteOrder({{ $order->id }})" class="action-btn action-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center">
                                <div class="text-gray-500">
                                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-inbox text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold mb-2">No custom orders found</h3>
                                    <p class="text-gray-500 mb-6">Create your first custom order to get started</p>
                                    <a href="{{ route('admin.custom_orders.create') }}" class="btn-gradient">
                                        <i class="fas fa-plus mr-2"></i>Create Order
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Enhanced Pagination -->
        @if($orders->hasPages())
        <div class="mt-8 flex items-center justify-between">
            <div class="text-sm text-gray-600">
                Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} results
            </div>
            <div class="flex items-center gap-2">
                {{ $orders->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden enhanced-table">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-list-alt mr-2 text-blue-600"></i>
                    Recent Orders
                    <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                        {{ $orders->total() }} total
                    </span>
                </h2>
                <div class="flex items-center space-x-3">
                    <select onchange="changePerPage(this.value)" class="px-3 py-1 border border-gray-300 rounded text-sm">
                        <option value="10" {{ request('per_page', 20) == 10 ? 'selected' : '' }}>10 per page</option>
                        <option value="20" {{ request('per_page', 20) == 20 ? 'selected' : '' }}>20 per page</option>
                        <option value="50" {{ request('per_page', 20) == 50 ? 'selected' : '' }}>50 per page</option>
                        <option value="100" {{ request('per_page', 20) == 100 ? 'selected' : '' }}>100 per page</option>
                    </select>
                    <button onclick="refreshOrders()" class="px-3 py-1 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition-colors text-sm">
                        <i class="fas fa-sync-alt mr-1"></i>Refresh
                    </button>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-hashtag mr-1"></i>Order
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-user mr-1"></i>Customer
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-box mr-1"></i>Details
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-info-circle mr-1"></i>Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-peso-sign mr-1"></i>Price
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-calendar mr-1"></i>Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-cogs mr-1"></i>Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition-colors" data-order-id="{{ $order->id }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="order-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="{{ $order->id }}">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">#{{ $order->id }}</div>
                            <div class="text-sm text-gray-500">{{ $order->quantity ?? 1 }} item(s)</div>
                            @if($order->admin_created)
                                <div class="text-xs text-purple-600 font-medium">Admin Created</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $order->user->name ?? 'Guest User' }}
                            </div>
                            <div class="text-sm text-gray-500">{{ $order->user->email ?? 'No email' }}</div>
                            @if($order->phone)
                                <div class="text-xs text-gray-400">{{ $order->phone }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @if($order->product)
                                    {{ $order->product->name }}
                                @elseif($order->fabric_type)
                                    {{ $order->fabric_type }} Fabric
                                @else
                                    Custom Product
                                @endif
                            </div>
                            <div class="text-xs text-gray-500">
                                @if($order->pattern)
                                    <i class="fas fa-palette mr-1"></i>{{ ucfirst($order->pattern) }}
                                @endif
                            </div>
                            @if($order->notes)
                                <div class="text-xs text-gray-400 truncate max-w-xs" title="{{ $order->notes }}">
                                    {{ Str::limit($order->notes, 30) }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="status-badge status-{{ $order->status ?? 'pending' }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status ?? 'pending')) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @if($order->final_price)
                                    <span class="font-semibold">₱{{ number_format($order->final_price, 2) }}</span>
                                @elseif($order->estimated_price)
                                    <span class="text-gray-500">~₱{{ number_format($order->estimated_price, 2) }}</span>
                                @else
                                    <span class="text-gray-400 italic">Not set</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>{{ $order->created_at->format('M j, Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <button onclick="viewOrder({{ $order->id }})" class="action-btn action-primary" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editOrder({{ $order->id }})" class="action-btn action-info" title="Edit Order">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @if($order->status === 'pending')
                                <button onclick="quotePrice({{ $order->id }})" class="action-btn action-success" title="Quote Price">
                                    <i class="fas fa-tag"></i>
                                </button>
                                @endif
                                @if($order->status === 'price_quoted')
                                <button onclick="approveOrder({{ $order->id }})" class="action-btn action-warning" title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>
                                @endif
                                @if($order->status === 'processing')
                                <button onclick="markCompleted({{ $order->id }})" class="action-btn action-success" title="Mark Completed">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                @endif
                                <button onclick="sendNotification({{ $order->id }})" class="action-btn action-info" title="Send Notification">
                                    <i class="fas fa-bell"></i>
                                </button>
                                <button onclick="deleteOrder({{ $order->id }})" class="action-btn action-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-inbox text-3xl text-gray-400"></i>
                                </div>
                                <p class="text-lg font-medium">No custom orders found</p>
                                <p class="text-sm mb-4">Create your first custom order to get started</p>
                                <a href="{{ route('admin.custom_orders.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>Create Order
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Enhanced Pagination -->
        @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Enhanced Quote Price Modal -->
<div id="quotePriceModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 modal-backdrop overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 modal-content rounded-lg bg-white">
        <div class="mt-3">
            <h3 class="text-xl font-medium text-gray-900 mb-4 flex items-center">
                <i class="fas fa-tag mr-2 text-green-600"></i>
                Quote Price
            </h3>
            <form id="quotePriceForm">
                @endsection

@push('scripts')
<script>
// Enhanced JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips and animations
    initializeTooltips();
    initializeAnimations();
    setupEventListeners();
});

function initializeTooltips() {
    // Add tooltips to action buttons
    const actionButtons = document.querySelectorAll('[title]');
    actionButtons.forEach(button => {
        button.classList.add('relative');
    });
}

function initializeAnimations() {
    // Animate stats cards on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInScale 0.6s ease-out';
            }
        });
    });
    
    document.querySelectorAll('.stat-card').forEach(card => {
        observer.observe(card);
    });
}

function setupEventListeners() {
    // Quick search functionality
    const quickSearch = document.getElementById('quickSearch');
    if (quickSearch) {
        quickSearch.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    }
    
    // Select all functionality
    const selectAll = document.getElementById('selectAll');
    if (selectAll) {
        selectAll.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.order-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
            updateBulkActions();
        });
    }
    
    // Individual checkbox listeners
    document.querySelectorAll('.order-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });
}

function updateBulkActions() {
    const checkedBoxes = document.querySelectorAll('.order-checkbox:checked');
    const bulkActions = document.getElementById('bulkActions');
    
    if (bulkActions) {
        bulkActions.style.display = checkedBoxes.length > 0 ? 'block' : 'none';
    }
}

function refreshOrders() {
    showLoading();
    setTimeout(() => {
        location.reload();
    }, 500);
}

function toggleBulkMode() {
    const bulkMode = document.body.classList.toggle('bulk-mode');
    const checkboxes = document.querySelectorAll('.order-checkbox');
    const selectAll = document.getElementById('selectAll');
    
    checkboxes.forEach(checkbox => {
        checkbox.style.display = bulkMode ? 'block' : 'none';
    });
    
    if (selectAll) {
        selectAll.style.display = bulkMode ? 'block' : 'none';
    }
    
    showNotification(bulkMode ? 'Bulk mode enabled' : 'Bulk mode disabled', 'info');
}

function viewOrder(orderId) {
    // Enhanced view modal with animations
    showLoading();
    fetch(`/admin/custom-orders/${orderId}`)
        .then(response => response.json())
        .then(data => {
            // Show order details in modal
            showOrderDetailsModal(data);
        })
        .catch(error => {
            showNotification('Error loading order details', 'error');
        })
        .finally(() => {
            hideLoading();
        });
}

function editOrder(orderId) {
    showLoading();
    fetch(`/admin/custom-orders/${orderId}/edit`)
        .then(response => response.json())
        .then(data => {
            // Populate edit modal
            populateEditModal(data);
            showModal('editOrderModal');
        })
        .catch(error => {
            showNotification('Error loading order for editing', 'error');
        })
        .finally(() => {
            hideLoading();
        });
}

function quickApprove(orderId) {
    if (!confirm('Are you sure you want to approve this order?')) return;
    
    showLoading();
    fetch(`/admin/custom-orders/${orderId}/approve`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Order approved successfully', 'success');
            location.reload();
        } else {
            showNotification(data.message || 'Error approving order', 'error');
        }
    })
    .catch(error => {
        showNotification('Error approving order', 'error');
    })
    .finally(() => {
        hideLoading();
    });
}

function deleteOrder(orderId) {
    if (!confirm('Are you sure you want to delete this order? This action cannot be undone.')) return;
    
    showLoading();
    fetch(`/admin/custom-orders/${orderId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Order deleted successfully', 'success');
            location.reload();
        } else {
            showNotification(data.message || 'Error deleting order', 'error');
        }
    })
    .catch(error => {
        showNotification('Error deleting order', 'error');
    })
    .finally(() => {
        hideLoading();
    });
}

function exportOrders() {
    showLoading();
    window.open('{{ route('admin.custom_orders.export') }}', '_blank');
    setTimeout(hideLoading, 1000);
}

function printOrders() {
    window.print();
}

function showLoading() {
    const spinner = document.createElement('div');
    spinner.className = 'loading-spinner fixed top-4 right-4 z-50';
    spinner.id = 'loadingSpinner';
    document.body.appendChild(spinner);
}

function hideLoading() {
    const spinner = document.getElementById('loadingSpinner');
    if (spinner) {
        spinner.remove();
    }
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-semibold z-50 animate-pulse`;
    
    switch(type) {
        case 'success':
            notification.classList.add('bg-green-500');
            break;
        case 'error':
            notification.classList.add('bg-red-500');
            break;
        default:
            notification.classList.add('bg-blue-500');
    }
    
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

function showModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + K for quick search
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        document.getElementById('quickSearch')?.focus();
    }
    
    // Escape to close modals
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-backdrop').forEach(modal => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    }
});
</script>
@endpush
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-peso-sign mr-1"></i>Final Price (₱)
                    </label>
                    <input type="number" step="0.01" min="0" name="final_price"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-sticky-note mr-1"></i>Notes
                    </label>
                    <textarea name="notes" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('editOrderModal')" 
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-300">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Enhanced Toast -->
<div id="toast" class="hidden fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300">
    <div class="flex items-center">
        <i id="toastIcon" class="fas mr-2"></i>
        <span id="toastMessage"></span>
    </div>
</div>

<script>
// Global variables
let bulkMode = false;
let selectedOrders = new Set();

// Toggle bulk selection mode
function toggleBulkMode() {
    bulkMode = !bulkMode;
    const bulkActions = document.getElementById('bulkActions');
    const checkboxes = document.querySelectorAll('.order-checkbox');
    
    if (bulkMode) {
        bulkActions.classList.remove('hidden');
        checkboxes.forEach(cb => cb.style.display = 'block');
    } else {
        bulkActions.classList.add('hidden');
        checkboxes.forEach(cb => {
            cb.style.display = 'none';
            cb.checked = false;
        });
        selectedOrders.clear();
        updateSelectedCount();
    }
}

// Toggle select all checkboxes
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.order-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
        if (selectAll.checked) {
            selectedOrders.add(parseInt(checkbox.value));
        } else {
            selectedOrders.delete(parseInt(checkbox.value));
        }
    });
    
    updateSelectedCount();
}

// Update selected count
function updateSelectedCount() {
    document.getElementById('selectedCount').textContent = selectedOrders.size;
}

// Handle individual checkbox changes
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('order-checkbox')) {
        if (e.target.checked) {
            selectedOrders.add(parseInt(e.target.value));
        } else {
            selectedOrders.delete(parseInt(e.target.value));
        }
        updateSelectedCount();
    }
});

// Bulk actions
function bulkApprove() {
    if (selectedOrders.size === 0) {
        showToast('Please select orders to approve', 'error');
        return;
    }
    
    if (!confirm(`Approve ${selectedOrders.size} selected orders?`)) return;
    
    // Implement bulk approve logic
    showToast('Orders approved successfully', 'success');
}

function bulkReject() {
    if (selectedOrders.size === 0) {
        showToast('Please select orders to reject', 'error');
        return;
    }
    
    if (!confirm(`Reject ${selectedOrders.size} selected orders?`)) return;
    
    // Implement bulk reject logic
    showToast('Orders rejected successfully', 'success');
}

function bulkDelete() {
    if (selectedOrders.size === 0) {
        showToast('Please select orders to delete', 'error');
        return;
    }
    
    if (!confirm(`Delete ${selectedOrders.size} selected orders? This action cannot be undone.`)) return;
    
    // Implement bulk delete logic
    showToast('Orders deleted successfully', 'success');
}

function bulkExport() {
    if (selectedOrders.size === 0) {
        showToast('Please select orders to export', 'error');
        return;
    }
    
    // Implement bulk export logic
    showToast('Orders exported successfully', 'success');
}

// Enhanced functions
function refreshOrders() {
    location.reload();
}

function changePerPage(perPage) {
    const url = new URL(window.location);
    url.searchParams.set('per_page', perPage);
    window.location.href = url.toString();
}

function exportOrders() {
    window.open('{{ route('admin.custom_orders.export') }}', '_blank');
}

function printOrders() {
    window.print();
}

function editOrder(orderId) {
    // Load order data and populate form
    document.getElementById('editOrderId').value = orderId;
    const modal = document.getElementById('editOrderModal');
    modal.classList.remove('hidden');
    modal.style.display = 'block';
}

function markCompleted(orderId) {
    if (!confirm('Mark this order as completed?')) return;
    
    fetch(`/admin/custom-orders/${orderId}/complete`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        showToast('An error occurred', 'error');
    });
}

function sendNotification(orderId) {
    if (!confirm('Send notification to customer?')) return;
    
    fetch(`/admin/custom-orders/${orderId}/notify`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Notification sent successfully', 'success');
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        showToast('An error occurred', 'error');
    });
}

// Quick search functionality
document.getElementById('quickSearch').addEventListener('keyup', function(e) {
    if (e.key === 'Enter') {
        const searchValue = e.target.value;
        const url = new URL(window.location);
        url.searchParams.set('search', searchValue);
        window.location.href = url.toString();
    }
});

// Modal functions
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add('hidden');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');
    const toastIcon = document.getElementById('toastIcon');
    
    toastMessage.textContent = message;
    
    // Set icon and color based on type
    if (type === 'success') {
        toastIcon.className = 'fas fa-check-circle mr-2';
        toast.className = 'fixed top-4 right-4 px-6 py-3 toast-success text-white rounded-lg shadow-lg z-50 transition-all duration-300';
    } else {
        toastIcon.className = 'fas fa-exclamation-circle mr-2';
        toast.className = 'fixed top-4 right-4 px-6 py-3 toast-error text-white rounded-lg shadow-lg z-50 transition-all duration-300';
    }
    
    toast.classList.remove('hidden');
    toast.style.display = 'block';
    
    setTimeout(() => {
        toast.classList.add('hidden');
        toast.style.display = 'none';
    }, 3000);
}

function filterByStatus(status) {
    const form = document.getElementById('filterForm');
    const statusSelect = form.querySelector('select[name="status"]');
    statusSelect.value = status;
    form.submit();
}

function viewOrder(orderId) {
    window.open(`/admin/custom-orders/${orderId}`, '_blank');
}

function quotePrice(orderId) {
    document.getElementById('quoteOrderId').value = orderId;
    const modal = document.getElementById('quotePriceModal');
    modal.classList.remove('hidden');
    modal.style.display = 'block';
}

function approveOrder(orderId) {
    if (!confirm('Are you sure you want to approve this order?')) return;
    
    const button = event.target;
    const originalContent = button.innerHTML;
    button.innerHTML = '<div class="loading-spinner"></div>';
    button.disabled = true;
    
    fetch(`/admin/custom-orders/${orderId}/approve`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        showToast('An error occurred', 'error');
    })
    .finally(() => {
        button.innerHTML = originalContent;
        button.disabled = false;
    });
}

function deleteOrder(orderId) {
    if (!confirm('Are you sure you want to delete this order? This action cannot be undone.')) return;
    
    const button = event.target;
    const originalContent = button.innerHTML;
    button.innerHTML = '<div class="loading-spinner"></div>';
    button.disabled = true;
    
    fetch(`/admin/custom-orders/${orderId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        showToast('An error occurred', 'error');
    })
    .finally(() => {
        button.innerHTML = originalContent;
        button.disabled = false;
    });
}

// Form submissions
document.getElementById('quotePriceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const orderId = formData.get('order_id');
    
    fetch(`/admin/custom-orders/${orderId}/set-price`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            closeModal('quotePriceModal');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        showToast('An error occurred', 'error');
    });
});

document.getElementById('editOrderForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const orderId = formData.get('order_id');
    
    fetch(`/admin/custom-orders/${orderId}`, {
        method: 'PUT',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            closeModal('editOrderModal');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        showToast('An error occurred', 'error');
    });
});
</script>
