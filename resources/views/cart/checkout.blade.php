@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">🛒 Checkout</h1>

    <form action="{{ route('cart.checkout.process') }}" method="POST">
        @csrf

        <table class="w-full table-auto border-collapse border border-gray-300 mb-6">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Product</th>
                    <th class="border px-4 py-2">Quantity</th>
                    <th class="border px-4 py-2">Price</th>
                    <th class="border px-4 py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    @php $subtotal = $item->quantity * $item->product->price; @endphp
                    <tr>
                        <td class="border px-4 py-2">{{ $item->product->name }}</td>
                        <td class="border px-4 py-2">{{ $item->quantity }}</td>
                        <td class="border px-4 py-2">₱{{ number_format($item->product->price, 2) }}</td>
                        <td class="border px-4 py-2">₱{{ number_format($subtotal, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="font-bold">
                    <td colspan="3" class="border px-4 py-2 text-right">Total</td>
                    <td class="border px-4 py-2">₱{{ number_format($total, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mb-6">
            <h2 class="font-semibold mb-2">Select Payment Method:</h2>
            <label class="mr-4">
                <input type="radio" name="payment_method" value="online" required>
                Online Payment
            </label>
            <label>
                <input type="radio" name="payment_method" value="bank_transfer">
                Bank Transfer
            </label>
        </div>

        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Place Order
        </button>
    </form>
</div>
@endsection
