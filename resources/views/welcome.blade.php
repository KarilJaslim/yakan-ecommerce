<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yakan - Traditional Crafts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    
    {{-- Navigation --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}" class="text-2xl font-bold text-red-800">YAKAN</a>
                    <div class="hidden md:flex ml-10 space-x-8">
                        <a href="#home" class="text-gray-700 hover:text-red-800">Home</a>
                        <a href="#products" class="text-gray-700 hover:text-red-800">Products</a>
                        <a href="#custom" class="text-gray-700 hover:text-red-800">Custom Orders</a>
                        <a href="#contact" class="text-gray-700 hover:text-red-800">Contact</a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-red-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </a>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-red-800">
                                <span>{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50" style="display: none;">
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Dashboard</a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                    <a href="{{ route('custom_orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Orders</a>
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login.user.form') }}" class="text-gray-700 hover:text-red-800">Login</a>
                        <a href="{{ route('register') }}" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-900">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section id="home" class="bg-red-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    @auth
                        <p class="text-yellow-400 mb-4">Welcome back, {{ explode(' ', auth()->user()->name)[0] }}!</p>
                    @else
                        <p class="text-yellow-400 mb-4">Traditional Handwoven Crafts</p>
                    @endauth
                    <h1 class="text-5xl font-bold mb-4">TUWAS YAKAN</h1>
                    <p class="text-xl mb-2">Weaving Through Generations</p>
                    <p class="text-red-100 mb-8">Discover authentic Yakan weaving. Each piece tells a story of tradition and cultural pride.</p>
                    <div class="space-x-4">
                        @auth
                            <a href="{{ route('products.index') }}" class="inline-block bg-white text-red-800 px-6 py-3 rounded font-semibold hover:bg-gray-100">Shop Now</a>
                        @else
                            <a href="{{ route('login.user.form') }}" class="inline-block bg-white text-red-800 px-6 py-3 rounded font-semibold hover:bg-gray-100">Shop Now</a>
                        @endauth
                        <a href="#custom" class="inline-block border-2 border-white text-white px-6 py-3 rounded font-semibold hover:bg-white hover:text-red-800">Custom Order</a>
                    </div>
                </div>
                <div>
                    @if(isset($featuredProducts) && $featuredProducts->isNotEmpty() && $featuredProducts->first()->image)
                        <img src="{{ asset('storage/' . $featuredProducts->first()->image) }}" alt="Featured Product" class="rounded-lg shadow-xl">
                    @else
                        <div class="bg-red-700 rounded-lg shadow-xl h-96 flex items-center justify-center">
                            <p class="text-white text-xl">Featured Product Image</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <p class="text-4xl font-bold text-red-800">{{ $totalProducts ?? 0 }}</p>
                    <p class="text-gray-600 mt-2">Products Available</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-red-800">{{ isset($categories) ? $categories->count() : 0 }}</p>
                    <p class="text-gray-600 mt-2">Categories</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-red-800">100%</p>
                    <p class="text-gray-600 mt-2">Handcrafted</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Products --}}
    <section id="products" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Featured Products</h2>
                <p class="text-gray-600">Browse our handpicked selection of authentic Yakan products</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @if(isset($featuredProducts) && $featuredProducts->isNotEmpty())
                    @foreach($featuredProducts->take(8) as $product)
                        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                            <div class="relative">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">No Image</span>
                                    </div>
                                @endif
                                <span class="absolute top-2 left-2 bg-red-800 text-white text-xs px-2 py-1 rounded">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($product->description ?? '', 80) }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-red-800">₱{{ number_format($product->price, 2) }}</span>
                                    @auth
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-red-800 text-white px-4 py-2 rounded text-sm hover:bg-red-900">Add to Cart</button>
                                        </form>
                                    @else
                                        <a href="{{ route('login.user.form') }}" class="bg-red-800 text-white px-4 py-2 rounded text-sm hover:bg-red-900">Add to Cart</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-4 text-center py-12">
                        <p class="text-gray-500">No products available at the moment.</p>
                    </div>
                @endif
            </div>

            <div class="text-center mt-12">
                @auth
                    <a href="{{ route('products.index') }}" class="inline-block bg-red-800 text-white px-8 py-3 rounded font-semibold hover:bg-red-900">View All Products</a>
                @else
                    <a href="{{ route('login.user.form') }}" class="inline-block bg-red-800 text-white px-8 py-3 rounded font-semibold hover:bg-red-900">View All Products</a>
                @endauth
            </div>
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Shop by Category</h2>
                <p class="text-gray-600">Explore our diverse range of traditional Yakan products</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if(isset($categories) && $categories->isNotEmpty())
                    @foreach($categories->take(6) as $category)
                        @if($category->products->isNotEmpty())
                            @php $firstProduct = $category->products->first(); @endphp
                            <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                                @if($firstProduct->image)
                                    <img src="{{ asset('storage/' . $firstProduct->image) }}" alt="{{ $category->name }}" class="w-full h-40 object-cover">
                                @else
                                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">{{ $category->name }}</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h3 class="font-semibold text-xl text-gray-900 mb-2">{{ $category->name }}</h3>
                                    <p class="text-gray-600 text-sm mb-4">{{ $category->products->count() }} products available</p>
                                    @auth
                                        <a href="{{ route('products.index', ['category' => $category->id]) }}" class="block w-full text-center bg-red-800 text-white px-4 py-2 rounded hover:bg-red-900">Browse {{ $category->name }}</a>
                                    @else
                                        <a href="{{ route('login.user.form') }}" class="block w-full text-center bg-red-800 text-white px-4 py-2 rounded hover:bg-red-900">Browse {{ $category->name }}</a>
                                    @endauth
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">No categories available.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Custom Orders CTA --}}
    <section id="custom" class="py-20 bg-red-800 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-4">Create Custom Orders</h2>
            <p class="text-xl text-red-100 mb-8">Design your own unique piece with your preferred colors, patterns, and dimensions.</p>
            @auth
                <a href="{{ route('custom_orders.create') }}" class="inline-block bg-white text-red-800 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100">Start Custom Order</a>
            @else
                <a href="{{ route('login.user.form') }}" class="inline-block bg-white text-red-800 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100">Start Custom Order</a>
            @endauth
        </div>
    </section>

    {{-- Contact Section --}}
    <section id="contact" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Get in Touch</h2>
                    <p class="text-gray-600 mb-8">Have questions? We'd love to hear from you.</p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-red-800 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-900">Address</h3>
                                <p class="text-gray-600">Upper Calarian, Zamboanga City, Philippines</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-red-800 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-900">Email</h3>
                                <p class="text-gray-600">info@tuwasyakan.com</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-red-800 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-900">Phone</h3>
                                <p class="text-gray-600">+63 XXX XXX XXXX</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                <input type="text" name="first_name" required class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-800 focus:border-transparent" placeholder="John">
                                @error('first_name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                <input type="text" name="last_name" required class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-800 focus:border-transparent" placeholder="Doe">
                                @error('last_name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-800 focus:border-transparent" placeholder="john@example.com">
                            @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                            <input type="text" name="subject" required class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-800 focus:border-transparent" placeholder="How can we help?">
                            @error('subject')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <textarea name="message" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-800 focus:border-transparent" placeholder="Your message..."></textarea>
                            @error('message')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        
                        <button type="submit" class="w-full bg-red-800 text-white px-6 py-3 rounded font-semibold hover:bg-red-900">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">YAKAN</h3>
                    <p class="text-gray-400 text-sm">Preserving traditional Yakan weaving heritage.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#home" class="hover:text-white">Home</a></li>
                        <li><a href="#products" class="hover:text-white">Products</a></li>
                        <li><a href="#custom" class="hover:text-white">Custom Orders</a></li>
                        <li><a href="#contact" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white">FAQs</a></li>
                        <li><a href="#" class="hover:text-white">Shipping</a></li>
                        <li><a href="#" class="hover:text-white">Returns</a></li>
                        <li><a href="#contact" class="hover:text-white">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li>Upper Calarian</li>
                        <li>Zamboanga City, Philippines</li>
                        <li class="pt-2">info@tuwasyakan.com</li>
                        <li>+63 XXX XXX XXXX</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; 2024 Yakan E-commerce. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- Alpine.js for dropdowns --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{-- Smooth scrolling --}}
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>