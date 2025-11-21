@extends('layouts.app')

@section('content')
<h1>Products</h1>

@auth
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
    @endif
@endauth

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table mt-3">
    <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Active</th>
            @auth
                @if(auth()->user()->role === 'admin')
                    <th>Actions</th>
                @endif
            @endauth
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category?->name ?? 'No Category' }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->is_active ? 'Yes' : 'No' }}</td>
            @auth
                @if(auth()->user()->role === 'admin')
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete product?')">Delete</button>
                        </form>
                    </td>
                @endif
            @endauth
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
