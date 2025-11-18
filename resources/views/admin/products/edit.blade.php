@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Edit Product</h1>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div>
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400" required>
        </div>

        {{-- Price --}}
        <div>
            <label class="block mb-1 font-semibold">Price</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400" required>
        </div>

        {{-- Description --}}
        <div>
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" rows="4" class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Current Image --}}
        <div>
            <label class="block mb-1 font-semibold">Current Image</label>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-40 h-40 object-cover mb-2 rounded">
            @else
                <p>No image uploaded.</p>
            @endif
        </div>

        {{-- New Image Upload --}}
        <div>
            <label class="block mb-1 font-semibold">New Image (optional)</label>
            <input type="file" name="image" accept="image/*" id="imageInput" class="w-full border p-2 rounded">
            <img id="previewImage" class="mt-3 w-40 h-40 object-cover rounded hidden" alt="Preview Image">
        </div>

        {{-- Status --}}
        <div>
            <label class="block mb-1 font-semibold">Status</label>
            <select name="status" class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400" required>
                <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 ml-2">Back to List</a>
        </div>
    </form>
</div>

{{-- Image Preview Script --}}
@section('scripts')
<script>
    const imageInput = document.getElementById('imageInput');
    const previewImage = document.getElementById('previewImage');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            previewImage.src = URL.createObjectURL(file);
            previewImage.classList.remove('hidden');
        } else {
            previewImage.src = '';
            previewImage.classList.add('hidden');
        }
    });
</script>
@endsection
