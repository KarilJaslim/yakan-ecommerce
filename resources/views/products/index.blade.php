@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Products</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price (₱)</th>
                <th>Stock</th>
                <th>Active</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->is_active ? 'Yes' : 'No' }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                    @else
                        N/A
                    @endif
                </td>
                <td class="d-flex gap-2">
                    <!-- Edit -->
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>

                    <!-- Delete -->
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>

                    <!-- Add to Cart -->
                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-sm btn-success">Add to Cart</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
