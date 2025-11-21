@extends('layouts.admin')
@section('title', 'Edit Product')
@section('content')

<h2 class="text-2xl font-bold mb-4">Edit Product</h2>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-medium">Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="border rounded px-3 py-1 w-full" required>
    </div>

    <div>
        <label class="block font-medium">Category</label>
        <select name="category_id" class="border rounded px-3 py-1 w-full">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-medium">Price</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="border rounded px-3 py-1 w-full" step="0.01" required>
    </div>

    <div>
        <label class="block font-medium">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="border rounded px-3 py-1 w-full" min="0" required>
    </div>

    <div>
        <label class="block font-medium">Description</label>
        <textarea name="description" class="border rounded px-3 py-1 w-full">{{ old('description', $product->description) }}</textarea>
    </div>

    <div>
        <label class="block font-medium">Current Image</label>
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="h-24 mb-2">
        @else
            <p>No image uploaded</p>
        @endif
        <label class="block font-medium">Change Image</label>
        <input type="file" name="image" class="border rounded px-3 py-1 w-full">
    </div>

    <div>
        <label class="block font-medium">Status</label>
        <select name="status" class="border rounded px-3 py-1 w-full" required>
            <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Update Product</button>
</form>
@endsection
