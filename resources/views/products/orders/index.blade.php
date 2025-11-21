@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order #{{ $order->id }}</h1>
    <p>Status: {{ $order->status }}</p>
    <p>Payment Status: {{ $order->payment_status }}</p>
    <p>Total: ₱{{ $order->total_amount }}</p>

    <h3>Items</h3>
    <ul>
        @foreach($order->items as $item)
            <li>{{ $item->product->name }} x {{ $item->quantity }} = ₱{{ $item->price }}</li>
        @endforeach
    </ul>
</div>
@endsection
