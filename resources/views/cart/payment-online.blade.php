@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">💳 Online Payment</h1>
    <p>Please pay the exact amount below using your preferred online payment method (e.g., GCash, PayPal).</p>

    <div class="mt-4 p-4 bg-gray-100 border rounded">
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Total Amount:</strong> ₱{{ number_format($order->total_amount, 2) }}</p>
        <p><strong>Payment Instructions:</strong> Scan QR or pay via your online wallet app.</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Back to Dashboard
        </a>
    </div>
</div>
@endsection
