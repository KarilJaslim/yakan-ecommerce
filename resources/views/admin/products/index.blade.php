@extends('layouts.admin')
@section('title', 'Products')
@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Products</h2>
    <a href="{{ route('admin.products.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Add Product</a>
</div>

<!-- Search & Filter -->
<form method="GET" class="flex space-x-3 mb-4">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="border rounded px-3 py-1 flex-1">
    <select name="status" class="border rounded px-3 py-1">
        <option value="">All Status</option>
        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Filter</button>
</form>

<table class="min-w-full bg-white rounded shadow">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">#</th>
            <th class="py-2 px-4 border-b">Name</th>
            <th class="py-2 px-4 border-b">Category</th>
            <th class="py-2 px-4 border-b">Price</th>
            <th class="py-2 px-4 border-b">Stock</th>
            <th class="py-2 px-4 border-b">Status</th>
            <th class="py-2 px-4 border-b">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
            <tr>
                <td class="py-2 px-4 border-b">{{ $loop->iteration + $products->firstItem() - 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                <td class="py-2 px-4 border-b">{{ $product->category?->name ?? 'No Category' }}</td>
                <td class="py-2 px-4 border-b">${{ number_format($product->price, 2) }}</td>
                <td class="py-2 px-4 border-b">{{ $product->stock }}</td>
                <td class="py-2 px-4 border-b">{{ ucfirst($product->status) }}</td>
                <td class="py-2 px-4 border-b space-x-2">
                    <a href="{{ route('admin.products.show', $product->id) }}" class="text-green-600 hover:underline">View</a>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center py-4">No products found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $products->links() }}
</div>

@endsection
