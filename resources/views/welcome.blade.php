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
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .hero-gradient { background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); }
        .pattern-dots { background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 20px 20px; }
        .glass-effect { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

{{-- Navbar --}}
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
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-red-600 transition font-medium">Admin Dashboard</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-red-600 transition font-medium">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-md hover:shadow-lg">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-600 transition font-medium">User Login</a>
                    <a href="{{ route('admin.login.form') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-md hover:shadow-lg">Admin Login</a>
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
                <div class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold">✨ Welcome to Premium Shopping</div>
                <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                    Discover Unique<br/><span class="text-red-200">Yakan Products</span>
                </h1>
                <p class="text-lg text-red-50 max-w-lg">
                    Experience the perfect blend of tradition and modernity. Order custom products and browse our exclusive collection with quality delivered to your doorstep.
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    @auth
                        <a href="{{ route('products.index') }}" class="px-8 py-4 bg-white text-red-600 rounded-lg hover:bg-gray-100 transition shadow-xl hover:shadow-2xl font-semibold transform hover:scale-105 duration-200">Shop Now</a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-red-600 rounded-lg hover:bg-gray-100 transition shadow-xl hover:shadow-2xl font-semibold transform hover:scale-105 duration-200">Login to Shop</a>
                    @endauth
                    <a href="#features" class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg hover:bg-white/10 transition font-semibold">Learn More</a>
                </div>

                {{-- Stats --}}
                <div class="flex items-center space-x-8 pt-8">
                    <div>
                        <div class="text-3xl font-bold">{{ $totalUsers ?? 0 }}+</div>
                        <div class="text-red-200 text-sm">Happy Customers</div>
                    </div>
                    <div class="h-12 w-px bg-white/30"></div>
                    <div>
                        <div class="text-3xl font-bold">{{ $totalOrders ?? 0 }}+</div>
                        <div class="text-red-200 text-sm">Orders Placed</div>
                    </div>
                    <div class="h-12 w-px bg-white/30"></div>
                    <div>
                        <div class="text-3xl font-bold">${{ number_format($totalSalesAmount ?? 0, 2) }}</div>
                        <div class="text-red-200 text-sm">Total Sales</div>
                    </div>
                </div>
            </div>

            {{-- Hero image/cards --}}
            <div class="hidden md:block animate-fade-in-up delay-200">
                <div class="relative">
                    <div class="absolute inset-0 bg-white/20 backdrop-blur-sm rounded-3xl transform rotate-6"></div>
                    <div class="relative bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20">
                        <div class="grid grid-cols-2 gap-4">
                            {{-- Card examples (Quality, Fast, Secure, Custom) --}}
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

{{-- Products Section --}}
<section id="products" class="py-24 px-4 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Featured <span class="text-red-600">Collections</span></h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Explore our curated selection of premium Yakan products</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($latestProducts as $product)
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer">
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="aspect-square w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                    <div class="text-white">
                        <h3 class="text-xl font-bold mb-1">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-200">{{ $product->category->name ?? 'General' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Contact CTA --}}
<section id="contact" class="py-24 px-4 bg-red-600 text-white text-center rounded-t-3xl">
    <h2 class="text-4xl md:text-5xl font-bold mb-4">Get in Touch</h2>
    <p class="text-lg mb-6 max-w-xl mx-auto">Have questions or want to request a custom product? Contact us now and our team will assist you immediately.</p>
    <a href="{{ route('contact.submit') }}" class="px-8 py-4 bg-white text-red-600 rounded-lg hover:bg-gray-100 transition shadow-xl font-semibold">Contact Us</a>
</section>

</body>
</html>
