{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yakan E-commerce - Custom Products & Premium Quality</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        
        .hero-gradient {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        }
        
        .pattern-dots {
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    {{-- Enhanced Navbar --}}
    <nav class="fixed w-full top-0 z-50 glass-effect border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-700 rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-red-600 to-red-800 bg-clip-text text-transparent">Yakan</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-700 hover:text-red-600 transition font-medium">Home</a>
                    <a href="#features" class="text-gray-700 hover:text-red-600 transition font-medium">Features</a>
                    <a href="#products" class="text-gray-700 hover:text-red-600 transition font-medium">Products</a>
                    <a href="#contact" class="text-gray-700 hover:text-red-600 transition font-medium">Contact</a>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-red-600 transition font-medium">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-md hover:shadow-lg">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-600 transition font-medium">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-md hover:shadow-lg">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 px-4 hero-gradient pattern-dots overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-white space-y-6 animate-fade-in-up">
                    <div class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold">
                        ✨ Welcome to Premium Shopping
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                        Discover Unique<br/>
                        <span class="text-red-200">Yakan Products</span>
                    </h1>
                    <p class="text-lg text-red-50 max-w-lg">
                        Experience the perfect blend of tradition and modernity. Order custom products and browse our exclusive collection with quality delivered to your doorstep.
                    </p>
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="{{ route('products.index') }}" class="px-8 py-4 bg-white text-red-600 rounded-lg hover:bg-gray-100 transition shadow-xl hover:shadow-2xl font-semibold transform hover:scale-105 duration-200">
                            Shop Now
                        </a>
                        <a href="#features" class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg hover:bg-white/10 transition font-semibold">
                            Learn More
                        </a>
                    </div>
                    <div class="flex items-center space-x-8 pt-8">
                        <div>
                            <div class="text-3xl font-bold">500+</div>
                            <div class="text-red-200 text-sm">Happy Customers</div>
                        </div>
                        <div class="h-12 w-px bg-white/30"></div>
                        <div>
                            <div class="text-3xl font-bold">1000+</div>
                            <div class="text-red-200 text-sm">Products Sold</div>
                        </div>
                        <div class="h-12 w-px bg-white/30"></div>
                        <div>
                            <div class="text-3xl font-bold">4.9★</div>
                            <div class="text-red-200 text-sm">Average Rating</div>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block animate-fade-in-up delay-200">
                    <div class="relative">
                        <div class="absolute inset-0 bg-white/20 backdrop-blur-sm rounded-3xl transform rotate-6"></div>
                        <div class="relative bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white rounded-2xl p-6 shadow-xl">
                                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-gray-800 font-semibold mb-1">Quality</h4>
                                    <p class="text-sm text-gray-600">Premium materials</p>
                                </div>
                                <div class="bg-white rounded-2xl p-6 shadow-xl mt-8">
                                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-gray-800 font-semibold mb-1">Fast</h4>
                                    <p class="text-sm text-gray-600">Quick delivery</p>
                                </div>
                                <div class="bg-white rounded-2xl p-6 shadow-xl">
                                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-gray-800 font-semibold mb-1">Secure</h4>
                                    <p class="text-sm text-gray-600">Safe payments</p>
                                </div>
                                <div class="bg-white rounded-2xl p-6 shadow-xl mt-8">
                                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-4">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-gray-800 font-semibold mb-1">Custom</h4>
                                    <p class="text-sm text-gray-600">Made for you</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="features" class="py-24 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Why Choose <span class="text-red-600">Yakan</span>?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Experience the difference with our premium services and dedication to quality</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group bg-gradient-to-br from-gray-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-red-200 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900 group-hover:text-red-600 transition">Custom Orders</h3>
                    <p class="text-gray-600 leading-relaxed">Create personalized products tailored to your exact needs. Our team works with you to bring your vision to life with exceptional craftsmanship.</p>
                    <a href="#" class="inline-flex items-center mt-4 text-red-600 font-semibold group-hover:gap-2 transition-all">
                        Learn more 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                
                <div class="group bg-gradient-to-br from-gray-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-red-200 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900 group-hover:text-red-600 transition">Secure Payment</h3>
                    <p class="text-gray-600 leading-relaxed">We support multiple payment methods including GCash, credit cards, and debit cards. Your transactions are encrypted and completely secure.</p>
                    <a href="#" class="inline-flex items-center mt-4 text-red-600 font-semibold group-hover:gap-2 transition-all">
                        Learn more 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                
                <div class="group bg-gradient-to-br from-gray-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-red-200 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900 group-hover:text-red-600 transition">Fast Delivery</h3>
                    <p class="text-gray-600 leading-relaxed">Receive your orders quickly with our reliable shipping partners. Track your package in real-time from our warehouse to your doorstep.</p>
                    <a href="#" class="inline-flex items-center mt-4 text-red-600 font-semibold group-hover:gap-2 transition-all">
                        Learn more 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Product Categories Section --}}
    <section id="products" class="py-24 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Featured <span class="text-red-600">Collections</span></h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Explore our curated selection of premium Yakan products</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="aspect-square bg-gradient-to-br from-red-400 to-red-600"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div class="text-white">
                            <h3 class="text-xl font-bold mb-1">Traditional Weaves</h3>
                            <p class="text-sm text-gray-200">Handcrafted textiles</p>
                        </div>
                    </div>
                </div>
                
                <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="aspect-square bg-gradient-to-br from-orange-400 to-red-500"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div class="text-white">
                            <h3 class="text-xl font-bold mb-1">Custom Apparel</h3>
                            <p class="text-sm text-gray-200">Personalized clothing</p>
                        </div>
                    </div>
                </div>
                
                <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="aspect-square bg-gradient-to-br from-red-500 to-pink-500"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div class="text-white">
                            <h3 class="text-xl font-bold mb-1">Home Decor</h3>
                            <p class="text-sm text-gray-200">Elegant pieces</p>
                        </div>
                    </div>
                </div>
                
                <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="aspect-square bg-gradient-to-br from-red-600 to-red-800"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                        <div class="text-white">
                            <h3 class="text-xl font-bold mb-1">Accessories</h3>
                            <p class="text-sm text-gray-200">Unique designs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 px-4 bg-white">
        <div class="max-w-4xl mx-auto text-center">
            <div class="bg-gradient-to-br from-red-600 to-red-800 rounded-3xl p-12 shadow-2xl">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Ready to Start Shopping?</h2>
                <p class="text-xl text-red-100 mb-8 max-w-2xl mx-auto">Join thousands of satisfied customers and discover the perfect products for you</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('products.index') }}" class="px-8 py-4 bg-white text-red-600 rounded-lg hover:bg-gray-100 transition shadow-xl hover:shadow-2xl font-semibold transform hover:scale-105 duration-200">
                        Browse Products
                    </a>
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg hover:bg-white/10 transition font-semibold">
                        Create Account
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-700 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">Yakan</span>
                    </div>
                    <p class="text-sm text-gray-400">Premium Yakan products delivered with care and quality.</p>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Shop</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-red-500 transition">All Products</a></li>
                        <li><a href="#" class="hover:text-red-500 transition">Custom Orders</a></li>
                        <li><a href="#" class="hover:text-red-500 transition">New Arrivals</a></li>
                        <li><a href="#" class="hover:text-red-500 transition">Sale</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-red-500 transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-red-500 transition">FAQs</a></li>
                        <li><a href="#" class="hover:text-red-500 transition">Shipping Info</a></li>
                        <li><a href="#" class="hover:text-red-500 transition">Returns</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Connect</h4>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-lg flex items-center justify-center transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-lg flex items-center justify-center transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-lg flex items-center justify-center transition">
                            <svg class="w-5