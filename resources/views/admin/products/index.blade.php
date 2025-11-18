@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Products</h1>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Search & Filter --}}
    <form action="{{ route('admin.products.index') }}" method="GET" class="mb-4 flex flex-wrap gap-2 items-center">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..." class="border p-2 rounded flex-1 min-w-[200px] focus:ring-2 focus:ring-blue-400">
        <select name="status" class="border p-2 rounded focus:ring-2 focus:ring-blue-400">
            <option value="">All Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
        <a href="{{ route('admin.products.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Reset</a>
    </form>

    {{-- Add Product Button --}}
    <div class="mb-4">
        <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add New Product</a>
    </div>

    {{-- Product Table --}}
    <div class="overflow-x-auto border rounded">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Image</th>
                    <th class="py-2 px-4 border-b">Price</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $product->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                        <td class="py-2 px-4 border-b">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-16 h-16 object-cover rounded">
                            @else
                                <span class="text-gray-400">No image</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">${{ number_format($product->price, 2) }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="{{ $product->status == 'active' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b space-x-2">
                            <a href="{{ route('admin.products.show', $product->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">View</a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 px-4 text-center text-gray-500">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
