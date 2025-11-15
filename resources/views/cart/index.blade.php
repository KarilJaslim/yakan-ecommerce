@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h2 class="text-2xl font-bold mb-4">Your Cart</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Product</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach(session('cart') as $id => $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <tr class="border-b">
                        <td class="px-4 py-2">
                            @if($item['image'])
                                <img src="{{ asset('storage/'.$item['image']) }}" class="w-16 h-16 object-cover" alt="{{ $item['name'] }}">
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $item['name'] }}</td>
                        <td class="px-4 py-2">{{ number_format($item['price'], 2) }}</td>
                        <td class="px-4 py-2">{{ $item['quantity'] }}</td>
                        <td class="px-4 py-2">{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('cart.remove', $id) }}" class="text-red-500 hover:underline">Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium mb-1">Shipping Address:</label>
                    <input type="text" name="shipping_address" required
                           class="w-full border px-2 py-1 rounded"
                           placeholder="Enter your shipping address">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Payment Method:</label>
                    <select name="payment_method" required class="w-full border px-2 py-1 rounded">
                        <option value="gcash">GCash</option>
                        <option value="credit_card">Credit/Debit Card</option>
                    </select>
                </div>

                <div class="flex justify-between items-center">
                    <p class="text-xl font-bold">Total: ₱{{ number_format($total, 2) }}</p>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Place Order
                    </button>
                </div>
            </form>
        </div>
    @else
        <p class="text-gray-500">Your cart is empty.</p>
    @endif
</div>
@endsection
