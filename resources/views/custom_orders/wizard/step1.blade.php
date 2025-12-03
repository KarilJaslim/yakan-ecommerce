@extends('layouts.app')

@section('title', 'Select Fabric - Custom Order')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-blue-50">
    <!-- Enhanced Progress Bar -->
    <div class="bg-white shadow-lg border-b border-gray-200">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-center space-x-6">
                <div class="flex items-center group cursor-pointer">
                    <div class="relative">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-lg transform transition-all duration-300 group-hover:scale-110">
                            1
                        </div>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    </div>
                    <span class="ml-3 font-bold text-purple-600">Fabric</span>
                </div>
                <div class="w-20 h-1 bg-gradient-to-r from-purple-600 to-gray-300 rounded-full"></div>
                <div class="flex items-center group cursor-pointer opacity-60">
                    <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-300 group-hover:scale-110">
                        2
                    </div>
                    <span class="ml-3 font-medium text-gray-500">Design</span>
                </div>
                <div class="w-20 h-1 bg-gray-300 rounded-full"></div>
                <div class="flex items-center group cursor-pointer opacity-60">
                    <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-300 group-hover:scale-110">
                        3
                    </div>
                    <span class="ml-3 font-medium text-gray-500">Details</span>
                </div>
                <div class="w-20 h-1 bg-gray-300 rounded-full"></div>
                <div class="flex items-center group cursor-pointer opacity-60">
                    <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-300 group-hover:scale-110">
                        4
                    </div>
                    <span class="ml-3 font-medium text-gray-500">Review</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 py-12">
            <div class="text-center">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent mb-4">Choose Your Fabric</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Select the perfect fabric foundation for your custom Yakan pattern masterpiece</p>
            </div>
        </div>
    </div>

    <!-- Enhanced Fabric Selection Form -->
    <div class="container mx-auto px-4 py-8">
        <form action="{{ route('custom_orders.store.step1') }}" method="POST" id="fabricSelectionForm">
            @csrf
            
            <!-- Fabric Type Selection with Enhanced Cards -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 mb-8">
                <div class="flex items-center mb-6">
                    <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900">Choose Fabric Type</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach(['Cotton', 'Silk', 'Polyester Cotton Blend', 'Linen', 'Canvas', 'Jersey Knit'] as $fabricType)
                        <div class="fabric-option group relative bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-xl p-6 cursor-pointer hover:border-purple-500 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1" 
                             onclick="selectFabric('{{ $fabricType }}')" 
                             data-fabric="{{ $fabricType }}">
                            <div class="absolute -top-2 -right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="bg-gradient-to-r from-purple-600 to-blue-600 text-white text-xs px-2 py-1 rounded-full font-semibold">Click to Select</span>
                            </div>
                            <div class="flex items-center mb-4">
                                <div class="w-5 h-5 border-2 border-gray-300 rounded-full mr-3 transition-all duration-300 group-hover:border-purple-500"></div>
                                <input type="radio" name="fabric_type" value="{{ $fabricType }}" class="sr-only" id="fabric_{{ str_replace(' ', '_', strtolower($fabricType)) }}">
                                <label for="fabric_{{ str_replace(' ', '_', strtolower($fabricType)) }}" class="font-bold text-gray-900 cursor-pointer text-lg group-hover:text-purple-600 transition-colors">{{ $fabricType }}</label>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $fabricType }} fabric perfect for custom Yakan patterns with excellent texture and durability</p>
                            <div class="mt-4 flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Premium quality
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @error('fabric_type')
                    <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-red-600 text-sm font-medium">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <!-- Enhanced Fabric Specifications -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 mb-8">
                <div class="flex items-center mb-6">
                    <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900">Fabric Specifications</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="fabric_quantity_meters" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Quantity (meters) *
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   id="fabric_quantity_meters" 
                                   name="fabric_quantity_meters" 
                                   class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                                   step="0.1" 
                                   min="0.5" 
                                   max="100" 
                                   required
                                   placeholder="e.g., 2.5">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Minimum 0.5 meters, maximum 100 meters
                        </p>
                        @error('fabric_quantity_meters')
                            <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="intended_use" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Intended Use *
                        </label>
                        <div class="relative">
                            <select id="intended_use" 
                                    name="intended_use" 
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 appearance-none"
                                    required>
                                <option value="">Select intended use...</option>
                                <option value="clothing">👗 Clothing & Garments</option>
                                <option value="home_decor">🏠 Home Decor</option>
                                <option value="crafts">🎨 Crafts & Accessories</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        @error('intended_use')
                            <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Enhanced Additional Details -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 mb-8">
                <div class="flex items-center mb-6">
                    <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900">Additional Details (Optional)</h3>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <label for="fabric_specifications" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Fabric Specifications
                        </label>
                        <textarea id="fabric_specifications" 
                                  name="fabric_specifications" 
                                  rows="4"
                                  class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                                  placeholder="e.g., Medium weight, smooth texture, breathable fabric with good drape..."></textarea>
                        <p class="text-sm text-gray-500 mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Describe any specific fabric characteristics you need
                        </p>
                    </div>
                    
                    <div>
                        <label for="special_requirements" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                            Special Requirements
                        </label>
                        <textarea id="special_requirements" 
                                  name="special_requirements" 
                                  rows="4"
                                  class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                                  placeholder="e.g., Waterproof, fire-retardant, UV protection, eco-friendly..."></textarea>
                        <p class="text-sm text-gray-500 mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Any special treatments or requirements
                        </p>
                    </div>
                </div>
            </div>

            <!-- Enhanced Submit Button -->
            <div class="flex justify-center">
                <button type="submit" 
                        class="group relative px-12 py-4 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-xl font-bold hover:from-purple-700 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                        Continue to Pattern Selection
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                </button>
            </div>
        </form>
    </div>

    <!-- Enhanced Information Section -->
    <div class="bg-gradient-to-r from-blue-50 to-purple-50 border-t border-blue-200">
        <div class="container mx-auto px-4 py-8">
            <div class="flex items-start space-x-4">
                <div class="text-blue-600 mt-1 flex-shrink-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-blue-900 text-lg mb-2">About Fabric Customization</h4>
                    <p class="text-sm text-blue-800 leading-relaxed">
                        Our fabric customization process combines traditional Yakan weaving techniques with modern fabric technology. 
                        After you submit your request, our master craftsmen will review your specifications and provide a custom quote 
                        based on fabric type, pattern complexity, and quantity. Each piece is carefully crafted to honor the 
                        rich cultural heritage of Yakan textile art.
                    </p>
                    <div class="mt-4 flex items-center space-x-6 text-sm text-blue-700">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Authentic Yakan patterns
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Premium quality fabrics
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Custom craftsmanship
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function selectFabric(fabricType) {
    // Remove previous selection
    document.querySelectorAll('.fabric-option').forEach(el => {
        el.classList.remove('border-purple-500', 'bg-purple-50', 'ring-4', 'ring-purple-200');
        const radio = el.querySelector('input[type="radio"]');
        const indicator = el.querySelector('.border-gray-300');
        if (radio) radio.checked = false;
        if (indicator) {
            indicator.classList.remove('bg-purple-600', 'border-purple-600');
            indicator.classList.add('border-gray-300');
        }
    });
    
    // Add selection to clicked fabric
    const clickedOption = event.currentTarget;
    clickedOption.classList.add('border-purple-500', 'bg-purple-50', 'ring-4', 'ring-purple-200');
    
    // Update radio button and visual indicator
    const radioInput = clickedOption.querySelector('input[type="radio"]');
    const indicator = clickedOption.querySelector('.border-gray-300');
    if (radioInput) {
        radioInput.checked = true;
    }
    if (indicator) {
        indicator.classList.remove('border-gray-300');
        indicator.classList.add('bg-purple-600', 'border-purple-600');
    }
    
    // Add animation
    clickedOption.style.animation = 'pulse 0.5s ease-out';
}

// Enhanced form validation with better UX
document.getElementById('fabricSelectionForm').addEventListener('submit', function(e) {
    const fabricType = document.querySelector('input[name="fabric_type"]:checked');
    const quantity = document.getElementById('fabric_quantity_meters').value;
    const intendedUse = document.getElementById('intended_use').value;
    
    if (!fabricType) {
        e.preventDefault();
        showNotification('Please select a fabric type', 'warning');
        return false;
    }
    
    if (!quantity || quantity < 0.5 || quantity > 100) {
        e.preventDefault();
        showNotification('Please enter a valid quantity between 0.5 and 100 meters', 'warning');
        return false;
    }
    
    if (!intendedUse) {
        e.preventDefault();
        showNotification('Please select the intended use for this fabric', 'warning');
        return false;
    }
    
    // Show loading state
    const submitBtn = e.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="flex items-center"><svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Processing...</span>';
    submitBtn.disabled = true;
    
    showNotification('Processing your fabric selection...', 'info');
});

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-20 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
    
    const colors = {
        success: 'bg-green-500 text-white',
        warning: 'bg-yellow-500 text-white',
        error: 'bg-red-500 text-white',
        info: 'bg-blue-500 text-white'
    };
    
    notification.classList.add(...colors[type].split(' '));
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}
</script>

@push('styles')
<style>
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.fabric-option {
    transition: all 0.3s ease;
}

.fabric-option:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.fabric-option.selected {
    border-color: #9333ea;
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.1), rgba(59, 130, 246, 0.1));
    box-shadow: 0 0 30px rgba(147, 51, 234, 0.3);
}
</style>
@endpush

@endsection

