@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text display-4">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>

        @foreach(['pending','processing','completed','cancelled'] as $status)
        <div class="col-md-2">
            <div class="card text-white 
                {{ $status=='pending'?'bg-warning' : ($status=='processing'?'bg-info' : ($status=='completed'?'bg-success':'bg-danger')) }} mb-3">
                <div class="card-body">
                    <h6 class="card-title text-uppercase">{{ $status }}</h6>
                    <p class="card-text display-6">{{ $ordersByStatus[$status] ?? 0 }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <h3>Top Selling Products</h3>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Sold Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topProducts as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->order_items_sum_quantity ?? 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
