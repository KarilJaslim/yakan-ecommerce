<!-- resources/views/products/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category ? $product->category->name : 'None' }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->is_active ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
