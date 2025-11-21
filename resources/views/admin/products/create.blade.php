@extends('layouts.admin')
@section('title', 'Add Product')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg mt-6">
    <h2 class="text-2xl font-bold mb-6">Add Product</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Product Name -->
        <div>
            <label class="block font-medium text-gray-700">Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-red-600" required>
        </div>

        <!-- Category -->
        <div>
            <label class="block font-medium text-gray-700">Category</label>
            <select name="category_id"
                class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-red-600" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Price -->
        <div>
            <label class="block font-medium text-gray-700">Price</label>
            <input type="number" name="price" value="{{ old('price') }}"
                class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-red-600" step="0.01"
                required>
        </div>

        <!-- Stock -->
        <div>
            <label class="block font-medium text-gray-700">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', 0) }}"
                class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-red-600" min="0"
                required>
        </div>

        <!-- Description -->
        <div>
            <label class="block font-medium text-gray-700">Description</label>
            <textarea name="description"
                class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-red-600">{{ old('description') }}</textarea>
        </div>

        <!-- Image -->
        <div>
            <label class="block font-medium text-gray-700">Image</label>
            <input type="file" name="image"
                class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-red-600">
        </div>

        <!-- Status -->
        <div>
            <label class="block font-medium text-gray-700">Status</label>
            <select name="is_active"
                class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-red-600" required>
                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors duration-200">
            Create Product
        </button>
    </form>
</div>
@endsection
