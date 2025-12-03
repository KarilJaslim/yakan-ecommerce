@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6">

    {{-- Back Button --}}
    <div class="flex items-center justify-between mb-4">
        <a href="{{ route('admin_custom_orders.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">
            <span>←</span>
            <span>Back to Custom Orders</span>
        </a>
        <div class="text-sm text-gray-500">Created {{ $order->created_at->format('M d, Y h:i A') }}</div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-50 text-green-800 px-4 py-2 rounded-lg mb-4 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-2xl border border-gray-100">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Custom Order #{{ $order->id }}</h1>
            <div class="flex items-center gap-2">
                {{-- Order Status --}}
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : ($order->status === 'processing' ? 'bg-yellow-100 text-yellow-700' : ($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700')) }}">
                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                </span>
                
                {{-- Payment Status --}}
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-700' : ($order->payment_status === 'pending_verification' ? 'bg-yellow-100 text-yellow-700' : ($order->payment_status === 'failed' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700')) }}">
                    {{ $order->payment_status === 'pending_verification' ? 'Pending Verification' : ucfirst($order->payment_status) }}
                </span>
                
                {{-- Payment Method --}}
                @if($order->payment_method)
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                        {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                    </span>
                @endif
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="rounded-xl border border-gray-200 p-4">
                        <div class="text-xs uppercase tracking-wider text-gray-500">User</div>
                        <div class="mt-1 text-gray-900 font-medium">{{ $order->user->name ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-500">{{ $order->user->email ?? 'N/A' }}</div>
                    </div>
                    <div class="rounded-xl border border-gray-200 p-4">
                        <div class="text-xs uppercase tracking-wider text-gray-500">Quantity</div>
                        <div class="mt-1 text-gray-900 font-semibold">
                            @if($order->isFabricOrder())
                                {{ $order->formatted_fabric_quantity }}
                            @else
                                {{ $order->quantity }}
                            @endif
                        </div>
                    </div>
                    <div class="sm:col-span-2 rounded-xl border border-gray-200 p-4">
                        <div class="text-xs uppercase tracking-wider text-gray-500">
                            @if($order->isFabricOrder())
                                Fabric Details
                            @else
                                Specifications
                            @endif
                        </div>
                        <div class="mt-2 text-gray-800">
                            @if($order->isFabricOrder())
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm font-medium text-purple-900">Fabric Type:</span>
                                        <span class="text-sm text-gray-700 ml-2">{{ $order->fabric_type }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-purple-900">Intended Use:</span>
                                        <span class="text-sm text-gray-700 ml-2">{{ $order->intended_use_label }}</span>
                                    </div>
                                    @if($order->fabric_specifications)
                                        <div>
                                            <span class="text-sm font-medium text-purple-900">Specifications:</span>
                                            <p class="text-sm text-gray-700 mt-1">{{ $order->fabric_specifications }}</p>
                                        </div>
                                    @endif
                                    @if($order->special_requirements)
                                        <div>
                                            <span class="text-sm font-medium text-purple-900">Special Requirements:</span>
                                            <p class="text-sm text-gray-700 mt-1">{{ $order->special_requirements }}</p>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="whitespace-pre-line">{{ $order->specifications }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Payment Details --}}
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-3">Payment Details</h2>
                    <div class="rounded-xl border border-gray-200 p-4 space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Payment Method</span>
                            <span class="font-medium">
                                @if($order->payment_method)
                                    {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                                @else
                                    <span class="text-gray-400">Not selected</span>
                                @endif
                            </span>
                        </div>
                        @if($order->final_price)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Quoted Price</span>
                            <span class="font-semibold text-red-600">₱{{ number_format($order->final_price, 2) }}</span>
                        </div>
                        @endif
                        @if($order->transaction_id)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Transaction ID</span>
                            <span class="font-mono text-sm">{{ $order->transaction_id }}</span>
                        </div>
                        @endif
                        @if($order->paid_at)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Paid At</span>
                            <span class="font-medium">
                                @if(is_string($order->paid_at))
                                    {{ \Carbon\Carbon::parse($order->paid_at)->format('M d, Y h:i A') }}
                                @else
                                    {{ $order->paid_at->format('M d, Y h:i A') }}
                                @endif
                            </span>
                        </div>
                        @endif
                        @if($order->transfer_date)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Transfer Date</span>
                            <span class="font-medium">
                                @if(is_string($order->transfer_date))
                                    {{ \Carbon\Carbon::parse($order->transfer_date)->format('M d, Y') }}
                                @else
                                    {{ $order->transfer_date->format('M d, Y') }}
                                @endif
                            </span>
                        </div>
                        @endif
                        @if($order->payment_notes)
                        <div>
                            <span class="text-sm text-gray-600 block mb-1">Payment Notes</span>
                            <p class="text-sm text-gray-800 bg-gray-50 p-2 rounded">{{ $order->payment_notes }}</p>
                        </div>
                        @endif
                        @if($order->payment_receipt)
                        <div>
                            <span class="text-sm text-gray-600 block mb-1">Payment Receipt</span>
                            <a href="{{ asset('storage/' . $order->payment_receipt) }}" target="_blank" class="text-blue-600 hover:underline text-sm">View Receipt</a>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Design Upload --}}
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-3">Design</h2>
                    @if($order->design_upload)
                        <div class="rounded-xl border border-gray-200 p-3 bg-gray-50 inline-block">
                            <a href="{{ asset('storage/' . $order->design_upload) }}" target="_blank" class="block">
                                <img src="{{ asset('storage/' . $order->design_upload) }}" alt="Design" class="w-72 h-72 object-cover rounded-lg shadow-md">
                            </a>
                            <div class="mt-2 text-right">
                                <a href="{{ asset('storage/' . $order->design_upload) }}" download class="text-sm text-blue-600 hover:underline">Download</a>
                            </div>
                        </div>
                    @else
                        <div class="w-72 h-72 bg-gray-100 flex items-center justify-center rounded-xl border border-dashed border-gray-300 text-gray-500">
                            No Design Uploaded
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-1">
                {{-- Update Status Form --}}
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <h2 class="text-lg font-semibold mb-3 text-gray-900">Update Status</h2>
                    <form action="{{ route('admin_custom_orders.update_status', $order->id) }}" method="POST" class="flex flex-col gap-3">
                        @csrf
                        <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="pending" @selected($order->status === 'pending')>Pending</option>
                            <option value="processing" @selected($order->status === 'processing')>Processing</option>
                            <option value="completed" @selected($order->status === 'completed')>Completed</option>
                            <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                        </select>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            <span>Update</span>
                        </button>
                    </form>
                </div>

                {{-- Set Price for Customer Approval --}}
                @if($order->status === 'pending')
                <div class="bg-white mt-4 p-4 rounded-xl border border-gray-200 shadow-sm">
                    <h2 class="text-lg font-semibold mb-2 text-gray-900">📋 Review & Quote Price</h2>
                    <p class="text-sm text-gray-600 mb-4">Review the order details and provide a quote to the customer.</p>
                    
                    <form id="quotePriceForm" class="space-y-3">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Quoted Amount (₱) *</label>
                            <input type="number" name="price" step="0.01" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="0.00" required />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Requirements/Notes to Customer</label>
                            <textarea name="notes" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., We need exact measurements, Expected completion in 5 days..."></textarea>
                        </div>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 w-full font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Send Quote to Customer
                        </button>
                        <p class="text-xs text-gray-500">✓ Customer will be notified and can accept or reject this quote.</p>
                    </form>
                </div>
                
                {{-- Reject Order --}}
                <div class="bg-white mt-4 p-4 rounded-xl border border-red-200 shadow-sm">
                    <h2 class="text-lg font-semibold mb-2 text-red-700">❌ Reject Order</h2>
                    <p class="text-sm text-gray-600 mb-4">If you cannot fulfill this order, provide a reason for rejection.</p>
                    
                    <form id="rejectOrderForm" class="space-y-3">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rejection Reason *</label>
                            <textarea name="rejection_reason" rows="3" class="w-full border border-red-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="e.g., Cannot source the requested fabric, Timeline too short..." required></textarea>
                        </div>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 w-full font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reject Order
                        </button>
                        <p class="text-xs text-red-600">⚠️ This action will notify the customer and cancel the order.</p>
                    </form>
                </div>
                @elseif($order->status === 'price_quoted')
                <div class="bg-blue-50 mt-4 p-4 rounded-xl border border-blue-200">
                    <h2 class="text-lg font-semibold mb-2 text-blue-800">⏳ Waiting for Customer Decision</h2>
                    <div class="space-y-2 text-sm">
                        <p class="text-gray-700">
                            <span class="font-semibold">Quoted Price:</span> ₱{{ number_format($order->final_price, 2) }}
                        </p>
                        @if($order->admin_notes)
                        <p class="text-gray-700">
                            <span class="font-semibold">Your Notes:</span> {{ $order->admin_notes }}
                        </p>
                        @endif
                        <p class="text-gray-700">
                            <span class="font-semibold">Quoted At:</span> {{ $order->price_quoted_at->format('M d, Y h:i A') }}
                        </p>
                        @if($order->user_notified_at)
                        <p class="text-gray-700">
                            <span class="font-semibold">Customer Notified:</span> {{ $order->user_notified_at->format('M d, Y h:i A') }}
                        </p>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 mt-3">Customer can accept or reject your quote from their dashboard.</p>
                </div>
                @elseif($order->status === 'approved')
                <div class="bg-green-50 mt-4 p-4 rounded-xl border border-green-200">
                    <h2 class="text-lg font-semibold mb-2 text-green-800">✅ Customer Accepted Quote</h2>
                    <p class="text-sm text-gray-700 mb-2">
                        <span class="font-semibold">Agreed Price:</span> ₱{{ number_format($order->final_price, 2) }}
                    </p>
                    <p class="text-sm text-gray-700">
                        <span class="font-semibold">Accepted At:</span> {{ $order->approved_at->format('M d, Y h:i A') }}
                    </p>
                    <p class="text-xs text-gray-600 mt-3">Waiting for customer payment to start production.</p>
                </div>
                @elseif($order->status === 'rejected')
                <div class="bg-red-50 mt-4 p-4 rounded-xl border border-red-200">
                    <h2 class="text-lg font-semibold mb-2 text-red-800">❌ Order Rejected</h2>
                    @if($order->rejection_reason)
                    <p class="text-sm text-gray-700 mb-2">
                        <span class="font-semibold">Reason:</span> {{ $order->rejection_reason }}
                    </p>
                    @endif
                    @if($order->rejected_at)
                    <p class="text-sm text-gray-700">
                        <span class="font-semibold">Rejected At:</span> {{ $order->rejected_at->format('M d, Y h:i A') }}
                    </p>
                    @endif
                </div>
                @endif

                {{-- Payment Verification --}}
                @if($order->payment_status === 'pending_verification')
                    <div class="bg-yellow-50 border border-yellow-200 mt-4 p-4 rounded-xl">
                        <h2 class="text-lg font-semibold mb-2 text-yellow-800">Payment Verification</h2>
                        @if($order->transaction_id)
                            <p class="text-sm text-gray-700 mb-1">
                                Transaction ID: <span class="font-mono font-semibold">{{ $order->transaction_id }}</span>
                            </p>
                        @endif
                        @if($order->payment_receipt)
                            <p class="text-sm text-gray-700 mb-2">
                                Receipt uploaded:
                                <a href="{{ asset('storage/' . $order->payment_receipt) }}" target="_blank" class="text-blue-600 hover:underline ml-1">View</a>
                            </p>
                        @endif
                        @if($order->payment_notes)
                            <p class="text-sm text-gray-700 mb-3">
                                Notes: {{ $order->payment_notes }}
                            </p>
                        @endif
                        @if($order->transfer_date)
                            <p class="text-sm text-gray-700 mb-3">
                                Transfer Date: 
                                @if(is_string($order->transfer_date))
                                    {{ \Carbon\Carbon::parse($order->transfer_date)->format('M d, Y') }}
                                @else
                                    {{ $order->transfer_date->format('M d, Y') }}
                                @endif
                            </p>
                        @endif
                        <form action="{{ route('admin_custom_orders.verify_payment', $order->id) }}" method="POST" class="space-y-3 mt-3">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                                <select name="payment_status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="paid">Mark as Paid</option>
                                    <option value="failed">Mark as Failed</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Notes (optional)</label>
                                <textarea name="payment_notes" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Add verification notes..."></textarea>
                            </div>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold">
                                Update Payment Status
                            </button>
                        </form>
                    </div>
                @endif

                {{-- Payment Verification for Processing Orders --}}
                @if($order->status === 'processing' && in_array($order->payment_status, ['unpaid', 'pending', 'pending_verification']))
                    <div class="bg-yellow-50 border border-yellow-200 mt-4 p-4 rounded-xl">
                        <h2 class="text-lg font-semibold mb-2 text-yellow-800">Payment Verification Required</h2>
                        <p class="text-sm text-gray-700 mb-3">
                            Customer has accepted the quote and should complete payment. Verify payment when received.
                        </p>
                        @if($order->final_price)
                            <p class="text-sm text-gray-700 mb-3">
                                Expected Amount: <span class="font-semibold text-green-600">₱{{ number_format($order->final_price, 2) }}</span>
                            </p>
                        @endif
                        <form action="{{ route('admin_custom_orders.verify_payment', $order->id) }}" method="POST" class="space-y-3 mt-3">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                                <select name="payment_status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="paid">Mark as Paid</option>
                                    <option value="failed">Mark as Failed</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Notes (optional)</label>
                                <textarea name="payment_notes" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Add verification notes..."></textarea>
                            </div>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold">
                                Update Payment Status
                            </button>
                        </form>
                    </div>
                @endif

                {{-- API Payment Status Check --}}
                @if(in_array($order->payment_method, ['gcash', 'online_banking']) && in_array($order->payment_status, ['pending', 'unpaid']))
                    <div class="bg-blue-50 border border-blue-200 mt-4 p-4 rounded-xl">
                        <h2 class="text-lg font-semibold mb-2 text-blue-800">API Payment Status</h2>
                        <p class="text-sm text-gray-700 mb-3">
                            This payment was processed via {{ ucfirst($order->payment_method) }}. Status will be updated automatically via webhook.
                        </p>
                        @if($order->transaction_id)
                            <form action="{{ route('admin_custom_orders.check_payment', $order->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-semibold">
                                    Check Status Manually
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quote Price Form
    const quotePriceForm = document.getElementById('quotePriceForm');
    if (quotePriceForm) {
        quotePriceForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Sending...';
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch('{{ route("admin.custom_orders.quote_price", $order) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        price: formData.get('price'),
                        notes: formData.get('notes')
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Show success message
                    alert('✅ ' + data.message);
                    // Reload page to show updated status
                    window.location.reload();
                } else {
                    alert('❌ ' + data.message);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Failed to send quote. Please try again.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }
    
    // Reject Order Form
    const rejectOrderForm = document.getElementById('rejectOrderForm');
    if (rejectOrderForm) {
        rejectOrderForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!confirm('⚠️ Are you sure you want to reject this order? This action cannot be undone.')) {
                return;
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Rejecting...';
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch('{{ route("admin.custom_orders.reject", $order) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        rejection_reason: formData.get('rejection_reason')
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Show success message
                    alert('✅ ' + data.message);
                    // Reload page to show updated status
                    window.location.reload();
                } else {
                    alert('❌ ' + data.message);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Failed to reject order. Please try again.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }
});
</script>
@endpush

@endsection
