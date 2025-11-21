@extends('layouts.admin')
@section('title', 'Product Details')
@section('content')

<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Product Details</h1>

    <div class="bg-white border rounded p-6 shadow-md flex flex-col md:flex-row gap-6">
        {{-- Product Info --}}
        <div class="flex-1 space-y-3">
            <p><strong>ID:</strong> {{ $product->id }}</p>
            <p><strong>Name:</strong> {{ $product->name }}</p>
            <p><strong>Category:</strong> {{ $product->category?->name ?? 'No Category' }}</p>
            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p>
                <strong>Status:</strong>
                <span class="{{ $product->status == 'active' ? 'text-green-600' : 'text-red-600' }}">
                    {{ ucfirst($product->status) }}
                </span>
            </p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>
            <p><strong>Description:</strong></p>
            <p class="border p-2 rounded bg-gray-50">{{ $product->description ?? 'No description provided.' }}</p>
        </div>

        {{-- Product Image --}}
        @if($product->image)
            <div class="flex-shrink-0">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-64 h-64 object-cover rounded shadow">
            </div>
        @endif
    </div>

    {{-- Action Buttons --}}
    <div class="mt-6 space-x-2">
        <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Edit</a>
        <a href="{{ route('admin.products.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to List</a>
    </div>
</div>

@endsection
