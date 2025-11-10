<!-- resources/views/products/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>

    <p><strong>Category:</strong> {{ $product->category ? $product->category->name : 'None' }}</p>
    <p><strong>Price:</strong> {{ $product->price }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>
    <p><strong>Status:</strong> {{ $product->is_active ? 'Active' : 'Inactive' }}</p>
    <p><strong>Description:</strong> {{ $product->description }}</p>

    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" width="200">
    @endif

    <br><br>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
</div>
@endsection
