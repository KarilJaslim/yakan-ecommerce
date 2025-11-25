@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Create Custom Order</h1>
            <p class="text-gray-600">Customize your product with your specifications and design</p>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Side - Form -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                    <form action="{{ route('custom_orders.store') }}" method="POST" enctype="multipart/form-data" id="customOrderForm">
                        @csrf

                        <div class="p-8 space-y-8">
                            
                            <!-- Product Selection -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-900 mb-4">
                                    Select Product <span class="text-red-500">*</span>
                                </label>
                                
                                <!-- Hidden input to store selected product ID -->
                                <input type="hidden" name="product_id" id="product_id_input" required>
                                
                                <!-- Product Grid -->
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4" id="productGrid">
                                    @foreach($categories as $category)
                                        @foreach($category->products as $product)
                                            <div class="product-card cursor-pointer group border-2 border-gray-200 rounded-xl overflow-hidden hover:border-red-400 hover:shadow-lg transition-all duration-200"
                                                 data-product-id="{{ $product->id }}"
                                                 data-product-name="{{ $product->name }}"
                                                 data-product-type="{{ strtolower(str_replace(' ', '', $product->name)) }}">
                                                
                                                <!-- Product Image -->
                                                <div class="aspect-square bg-gray-100 relative overflow-hidden">
                                                    @if($product->image)
                                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                                             alt="{{ $product->name }}"
                                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                                    @else
                                                        <!-- Placeholder if no image -->
                                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    
                                                    <!-- Selected Checkmark -->
                                                    <div class="product-checkmark absolute top-2 right-2 w-6 h-6 bg-red-600 rounded-full items-center justify-center hidden">
                                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                
                                                <!-- Product Name -->
                                                <div class="p-3 bg-white">
                                                    <p class="text-sm font-semibold text-gray-900 text-center line-clamp-2">{{ $product->name }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
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

                            <!-- Color Customization Section -->
                            <div class="group" id="colorSection" style="display: none;">
                                <label class="block text-sm font-semibold text-gray-900 mb-4">
                                    Customize Colors
                                </label>
                                
                                <div class="space-y-4">
                                    <!-- Primary Color -->
                                    <div class="flex items-center space-x-4">
                                        <label class="w-32 text-sm font-medium text-gray-700">Primary Color</label>
                                        <input type="color" 
                                               id="primaryColor" 
                                               name="primary_color"
                                               value="#ef4444" 
                                               class="h-10 w-20 rounded-lg border-2 border-gray-200 cursor-pointer">
                                        <span id="primaryColorHex" class="text-sm text-gray-600 font-mono">#ef4444</span>
                                    </div>
                                    
                                    <!-- Secondary Color -->
                                    <div class="flex items-center space-x-4">
                                        <label class="w-32 text-sm font-medium text-gray-700">Secondary Color</label>
                                        <input type="color" 
                                               id="secondaryColor" 
                                               name="secondary_color"
                                               value="#3b82f6" 
                                               class="h-10 w-20 rounded-lg border-2 border-gray-200 cursor-pointer">
                                        <span id="secondaryColorHex" class="text-sm text-gray-600 font-mono">#3b82f6</span>
                                    </div>
                                    
                                    <!-- Accent Color -->
                                    <div class="flex items-center space-x-4">
                                        <label class="w-32 text-sm font-medium text-gray-700">Accent Color</label>
                                        <input type="color" 
                                               id="accentColor" 
                                               name="accent_color"
                                               value="#10b981" 
                                               class="h-10 w-20 rounded-lg border-2 border-gray-200 cursor-pointer">
                                        <span id="accentColorHex" class="text-sm text-gray-600 font-mono">#10b981</span>
                                    </div>
                                </div>
                                
                                <p class="mt-4 text-xs text-gray-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Drag the 3D preview to rotate and see your product from all angles
                                </p>
                            </div>

                            <!-- Specifications -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    Specifications
                                </label>
                                <textarea name="specifications" 
                                          rows="5" 
                                          class="block w-full px-4 py-3.5 text-gray-900 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 resize-none hover:border-gray-300" 
                                          placeholder="Describe your customization requirements in detail (e.g., sizes, materials, special features)...">{{ old('specifications') }}</textarea>
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
            </div>

            <!-- Right Side - 3D Product Preview -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden sticky top-8">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                        <h3 class="text-white font-semibold text-lg">3D Product Preview</h3>
                    </div>
                    
                    <div id="productPreview" class="p-6">
                        <!-- Empty State -->
                        <div id="emptyState" class="text-center py-12">
                            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="text-gray-500 text-sm">Select a product to see 3D preview</p>
                        </div>

                        <!-- 3D Product Viewer (Hidden Initially) -->
                        <div id="productCard" class="hidden">
                            <div class="mb-4">
                                <!-- 3D Canvas Container -->
                                <div class="aspect-square bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl overflow-hidden mb-4 relative">
                                    <canvas id="threejs-canvas" class="w-full h-full"></canvas>
                                    
                                    <!-- Loading Indicator -->
                                    <div id="loading-3d" class="absolute inset-0 flex items-center justify-center bg-gray-100">
                                        <div class="text-center">
                                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto mb-2"></div>
                                            <p class="text-sm text-gray-600">Loading 3D Model...</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <h4 id="productName" class="text-lg font-bold text-gray-900 mb-2">Product Name</h4>
                                
                                <!-- Color Swatches Display -->
                                <div class="space-y-2">
                                    <p class="text-xs font-semibold text-gray-700 uppercase tracking-wide">Selected Colors</p>
                                    <div class="flex space-x-2">
                                        <div class="flex-1">
                                            <div id="primarySwatch" class="h-10 rounded-lg border-2 border-gray-200 transition-colors duration-300" style="background-color: #ef4444;"></div>
                                            <p class="text-xs text-gray-500 mt-1 text-center">Primary</p>
                                        </div>
                                        <div class="flex-1">
                                            <div id="secondarySwatch" class="h-10 rounded-lg border-2 border-gray-200 transition-colors duration-300" style="background-color: #3b82f6;"></div>
                                            <p class="text-xs text-gray-500 mt-1 text-center">Secondary</p>
                                        </div>
                                        <div class="flex-1">
                                            <div id="accentSwatch" class="h-10 rounded-lg border-2 border-gray-200 transition-colors duration-300" style="background-color: #10b981;"></div>
                                            <p class="text-xs text-gray-500 mt-1 text-center">Accent</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

<!-- Three.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<!-- Scripts -->
<script>
// Global Three.js variables
let scene, camera, renderer, currentMesh;
let materials = {};
let isRotating = true;

// File Upload Preview
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

// Initialize Three.js Scene
function initThreeJS() {
    const canvas = document.getElementById('threejs-canvas');
    const container = canvas.parentElement;
    
    // Scene
    scene = new THREE.Scene();
    scene.background = new THREE.Color(0xf5f5f5);
    
    // Camera
    camera = new THREE.PerspectiveCamera(50, 1, 0.1, 1000);
    camera.position.set(0, 0, 5);
    
    // Renderer
    renderer = new THREE.WebGLRenderer({ 
        canvas: canvas, 
        antialias: true,
        alpha: true 
    });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    
    // Lighting
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
    scene.add(ambientLight);
    
    const directionalLight1 = new THREE.DirectionalLight(0xffffff, 0.8);
    directionalLight1.position.set(5, 5, 5);
    scene.add(directionalLight1);
    
    const directionalLight2 = new THREE.DirectionalLight(0xffffff, 0.4);
    directionalLight2.position.set(-5, -5, -5);
    scene.add(directionalLight2);
    
    // Mouse controls for rotation
    let isDragging = false;
    let previousMousePosition = { x: 0, y: 0 };
    
    canvas.addEventListener('mousedown', (e) => {
        isDragging = true;
        isRotating = false;
        previousMousePosition = { x: e.clientX, y: e.clientY };
    });
    
    canvas.addEventListener('mousemove', (e) => {
        if (isDragging && currentMesh) {
            const deltaX = e.clientX - previousMousePosition.x;
            const deltaY = e.clientY - previousMousePosition.y;
            
            currentMesh.rotation.y += deltaX * 0.01;
            currentMesh.rotation.x += deltaY * 0.01;
            
            previousMousePosition = { x: e.clientX, y: e.clientY };
        }
    });
    
    canvas.addEventListener('mouseup', () => {
        isDragging = false;
    });
    
    canvas.addEventListener('mouseleave', () => {
        isDragging = false;
    });
    
    // Touch controls for mobile
    canvas.addEventListener('touchstart', (e) => {
        isDragging = true;
        isRotating = false;
        const touch = e.touches[0];
        previousMousePosition = { x: touch.clientX, y: touch.clientY };
    });
    
    canvas.addEventListener('touchmove', (e) => {
        if (isDragging && currentMesh) {
            e.preventDefault();
            const touch = e.touches[0];
            const deltaX = touch.clientX - previousMousePosition.x;
            const deltaY = touch.clientY - previousMousePosition.y;
            
            currentMesh.rotation.y += deltaX * 0.01;
            currentMesh.rotation.x += deltaY * 0.01;
            
            previousMousePosition = { x: touch.clientX, y: touch.clientY };
        }
    });
    
    canvas.addEventListener('touchend', () => {
        isDragging = false;
    });
    
    // Handle window resize
    window.addEventListener('resize', () => {
        const width = container.clientWidth;
        const height = container.clientHeight;
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
    });
    
    animate();
}

// Create 3D Product based on type
function create3DProduct(productType) {
    // Clear existing mesh
    if (currentMesh) {
        scene.remove(currentMesh);
    }
    
    const group = new THREE.Group();
    
    // Create materials with transparency
    materials.primary = new THREE.MeshPhongMaterial({ 
        color: 0xef4444,
        transparent: true,
        opacity: 0.9,
        shininess: 100
    });
    
    materials.secondary = new THREE.MeshPhongMaterial({ 
        color: 0x3b82f6,
        transparent: true,
        opacity: 0.85,
        shininess: 80
    });
    
    materials.accent = new THREE.MeshPhongMaterial({ 
        color: 0x10b981,
        transparent: true,
        opacity: 0.9,
        shininess: 90
    });
    
    // Create different product shapes based on type
    // You can customize these shapes for different products
    
    // Main body (Primary Color)
    const mainGeometry = new THREE.BoxGeometry(2, 2.5, 0.3);
    const mainMesh = new THREE.Mesh(mainGeometry, materials.primary);
    mainMesh.position.set(0, 0, 0);
    group.add(mainMesh);
    
    // Secondary detail (Secondary Color)
    const detailGeometry = new THREE.CylinderGeometry(0.8, 0.8, 0.4, 32);
    const detailMesh = new THREE.Mesh(detailGeometry, materials.secondary);
    detailMesh.position.set(0, 0, 0.35);
    detailMesh.rotation.x = Math.PI / 2;
    group.add(detailMesh);
    
    // Accent pieces (Accent Color)
    const accentGeometry = new THREE.SphereGeometry(0.3, 32, 32);
    
    const accent1 = new THREE.Mesh(accentGeometry, materials.accent);
    accent1.position.set(-0.7, 0.9, 0.3);
    group.add(accent1);
    
    const accent2 = new THREE.Mesh(accentGeometry, materials.accent);
    accent2.position.set(0.7, 0.9, 0.3);
    group.add(accent2);
    
    const accent3 = new THREE.Mesh(accentGeometry, materials.accent);
    accent3.position.set(0, -0.9, 0.3);
    group.add(accent3);
    
    // Add some edge highlights
    const edgeGeometry = new THREE.TorusGeometry(0.8, 0.05, 16, 100);
    const edgeMaterial = new THREE.MeshPhongMaterial({ 
        color: 0xffffff,
        transparent: true,
        opacity: 0.5,
        shininess: 150
    });
    const edge = new THREE.Mesh(edgeGeometry, edgeMaterial);
    edge.position.set(0, 0, 0.4);
    group.add(edge);
    
    currentMesh = group;
    scene.add(group);
    
    // Hide loading indicator
    document.getElementById('loading-3d').style.display = 'none';
}

// Animation loop
function animate() {
    requestAnimationFrame(animate);
    
    // Auto-rotate when not dragging
    if (currentMesh && isRotating) {
        currentMesh.rotation.y += 0.005;
    }
    
    renderer.render(scene, camera);
}

// Update 3D model colors
function update3DColors() {
    if (!materials.primary) return;
    
    const primaryColor = document.getElementById('primaryColor').value;
    const secondaryColor = document.getElementById('secondaryColor').value;
    const accentColor = document.getElementById('accentColor').value;
    
    // Update materials
    materials.primary.color.setStyle(primaryColor);
    materials.secondary.color.setStyle(secondaryColor);
    materials.accent.color.setStyle(accentColor);
    
    // Update swatches
    document.getElementById('primarySwatch').style.backgroundColor = primaryColor;
    document.getElementById('secondarySwatch').style.backgroundColor = secondaryColor;
    document.getElementById('accentSwatch').style.backgroundColor = accentColor;
    
    // Update hex displays
    document.getElementById('primaryColorHex').textContent = primaryColor;
    document.getElementById('secondaryColorHex').textContent = secondaryColor;
    document.getElementById('accentColorHex').textContent = accentColor;
}

// Product Card Selection Handler
let selectedProductCard = null;

document.querySelectorAll('.product-card').forEach(card => {
    card.addEventListener('click', function() {
        // Remove selection from previous card
        if (selectedProductCard) {
            selectedProductCard.classList.remove('border-red-600', 'ring-2', 'ring-red-500');
            selectedProductCard.querySelector('.product-checkmark').classList.add('hidden');
            selectedProductCard.querySelector('.product-checkmark').classList.remove('flex');
        }
        
        // Add selection to current card
        this.classList.add('border-red-600', 'ring-2', 'ring-red-500');
        this.querySelector('.product-checkmark').classList.remove('hidden');
        this.querySelector('.product-checkmark').classList.add('flex');
        selectedProductCard = this;
        
        // Get product data
        const productId = this.getAttribute('data-product-id');
        const productName = this.getAttribute('data-product-name');
        const productType = this.getAttribute('data-product-type');
        
        // Update hidden input
        document.getElementById('product_id_input').value = productId;
        
        // Show product preview
        showProductPreview(productName, productType);
    });
});

function showProductPreview(productName, productType) {
    // Show product card and hide empty state
    document.getElementById('emptyState').classList.add('hidden');
    document.getElementById('productCard').classList.remove('hidden');
    document.getElementById('colorSection').style.display = 'block';
    document.getElementById('loading-3d').style.display = 'flex';
    
    // Update product name
    document.getElementById('productName').textContent = productName;
    
    // Initialize Three.js if not already done
    if (!renderer) {
        initThreeJS();
    }
    
    // Create 3D product
    setTimeout(() => {
        create3DProduct(productType);
        isRotating = true;
    }, 100);
    
    // Animate the card appearance
    const productCard = document.getElementById('productCard');
    productCard.style.opacity = '0';
    productCard.style.transform = 'translateY(20px)';
    setTimeout(() => {
        productCard.style.transition = 'all 0.3s ease-out';
        productCard.style.opacity = '1';
        productCard.style.transform = 'translateY(0)';
    }, 10);
}

// Add event listeners to color pickers
document.getElementById('primaryColor').addEventListener('input', update3DColors);
document.getElementById('secondaryColor').addEventListener('input', update3DColors);
document.getElementById('accentColor').addEventListener('input', update3DColors);
</script>
@endsection