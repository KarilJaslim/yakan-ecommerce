@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">🏦 Bank Transfer</h1>
    <p>Please transfer the exact amount to the bank account below:</p>

    <div class="mt-4 p-4 bg-gray-100 border rounded">
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Total Amount:</strong> ₱{{ number_format($order->total_amount, 2) }}</p>
        <p><strong>Bank Name:</strong> Example Bank</p>
        <p><strong>Account Name:</strong> Your Company Name</p>
        <p><strong>Account Number:</strong> 1234-5678-9012</p>
        <p><strong>Instructions:</strong> After payment, please upload your proof of payment or notify us.</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Back to Dashboard
        </a>
    </div>
</div>
@endsection
