@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Create Custom Order</h1>
            <p class="text-gray-600">Customize your product with your specifications and design</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <form action="{{ route('custom_orders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="p-8 space-y-8">
                    
                    <!-- Product Selection -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Select Product <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="product_id" 
                                    class="block w-full px-4 py-3.5 text-gray-900 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300" 
                                    required>
                                <option value="">Choose a product to customize...</option>
                                @foreach($categories as $category)
                                    <optgroup label="{{ $category->name }}" class="font-semibold text-gray-700">
                                        @foreach($category->products as $product)
                                            <option value="{{ $product->id }}" class="font-normal">{{ $product->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('product_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Specifications -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Specifications
                        </label>
                        <textarea name="specifications" 
                                  rows="5" 
                                  class="block w-full px-4 py-3.5 text-gray-900 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 resize-none hover:border-gray-300" 
                                  placeholder="Describe your customization requirements in detail (e.g., colors, sizes, materials, special features)...">{{ old('specifications') }}</textarea>
                        <p class="mt-2 text-xs text-gray-500">Be as detailed as possible to help us understand your vision</p>
                        @error('specifications')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Design Upload -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Upload Design
                        </label>
                        <div class="relative">
                            <input type="file" 
                                   name="design_upload" 
                                   id="design_upload"
                                   class="hidden"
                                   accept="image/*,.pdf,.ai,.psd">
                            <label for="design_upload" 
                                   class="flex flex-col items-center justify-center w-full h-40 px-4 py-6 bg-gray-50 border-2 border-gray-200 border-dashed rounded-xl cursor-pointer hover:bg-gray-100 hover:border-red-300 transition-all duration-200">
                                <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    <span class="text-red-600 hover:text-red-700">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-gray-500">PNG, JPG, PDF, AI, PSD up to 10MB</p>
                            </label>
                        </div>
                        <div id="file-name" class="mt-3 text-sm text-gray-600 hidden">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-50 text-red-700">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"/>
                                </svg>
                                <span id="file-name-text"></span>
                            </span>
                        </div>
                        @error('design_upload')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Quantity -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Quantity <span class="text-red-500">*</span>
                        </label>
                        <div class="relative max-w-xs">
                            <input type="number" 
                                   name="quantity" 
                                   min="1" 
                                   class="block w-full px-4 py-3.5 text-gray-900 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 hover:border-gray-300" 
                                   value="{{ old('quantity', 1) }}" 
                                   required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Minimum order quantity: 1 unit</p>
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                <!-- Footer with Submit Button -->
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-600">
                            <span class="text-red-500">*</span> Required fields
                        </p>
                        <button type="submit" 
                                class="inline-flex items-center px-8 py-3.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Submit Order
                        </button>
                    </div>
                </div>

            </form>
        </div>

        <!-- Info Cards -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl p-6 shadow-md">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Fast Processing</h3>
                <p class="text-sm text-gray-600">Your custom order will be reviewed within 24 hours</p>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-md">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Quality Guaranteed</h3>
                <p class="text-sm text-gray-600">Premium materials and expert craftsmanship</p>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-md">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Support Available</h3>
                <p class="text-sm text-gray-600">Our team is here to help with any questions</p>
            </div>
        </div>

    </div>
</div>

<!-- File Upload Preview Script -->
<script>
document.getElementById('design_upload').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name;
    const fileNameDisplay = document.getElementById('file-name');
    const fileNameText = document.getElementById('file-name-text');
    
    if (fileName) {
        fileNameText.textContent = fileName;
        fileNameDisplay.classList.remove('hidden');
    } else {
        fileNameDisplay.classList.add('hidden');
    }
});
</script>
@endsection