<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yakan - Traditional Crafts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .dropdown:hover .dropdown-menu { display: block; }
        .dropdown-menu { display: none; position: absolute; right: 0; top: 100%; margin-top: 0.5rem; min-width: 15rem; background: white; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); z-index: 50; }
    </style>
</head>
<body class="bg-white">
    {{-- Top Banner --}}
    <div class="bg-red-900 text-white text-center py-2 text-sm">
        Free Shipping on Orders Over ₱500 | Authentic Handwoven Yakan Crafts
    </div>
    {{-- Nav --}}
    <nav class="bg-white border-b sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 18c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z"/>
                    </svg>
                    <span class="text-2xl font-bold bg-gradient-to-r from-red-800 to-red-900 bg-clip-text text-transparent">yakan</span>
                </a>
                
                {{-- Search Bar --}}
                <div class="hidden md:flex flex-1 max-w-2xl mx-8">
                    <div class="relative w-full">
                        <input type="text" placeholder="Search for products..." class="w-full px-4 py-2 border border-gray-300 rounded-sm focus:outline-none focus:border-red-800">
                        <button class="absolute right-0 top-0 h-full px-6 bg-red-900 text-white hover:bg-red-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                {{-- Right Menu --}}
                <div class="flex items-center gap-6">
                    @auth
                        {{-- Cart --}}
                        <a href="{{ route('cart.index') }}" class="relative hover:text-red-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="absolute -top-2 -right-2 bg-red-800 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                        </a>
                        
                        {{-- User Dropdown --}}
                        <div class="dropdown relative">
                            <button class="flex items-center gap-2 hover:text-red-800">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="hidden md:block">{{ explode(' ', auth()->user()->name)[0] }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
                            <div class="dropdown-menu">
                                <div class="px-4 py-3 border-b">
                                    <p class="font-semibold text-sm">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                                <div class="py-1">
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Dashboard</a>
                                    @else
                                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">My Account</a>
                                        <a href="{{ route('custom_orders.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">My Orders</a>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-50 text-red-600">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login.user.form') }}" class="flex items-center gap-1 hover:text-red-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="hidden md:block text-sm">Login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        
        {{-- Category Nav --}}
        <div class="border-t">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex gap-8 text-sm h-12 items-center">
                    <a href="{{ url('/') }}" class="hover:text-red-800 font-medium">Home</a>
                    <a href="{{ auth()->check() ? route('products.index') : route('login.user.form') }}" class="hover:text-red-800 font-medium">All Products</a>
                    <a href="#shop" class="hover:text-red-800">Shop</a>
                    <a href="#custom" class="hover:text-red-800">Custom Orders</a>
                </div>
            </div>
        </div>
    </nav>
    {{-- Hero Carousel --}}
    <section class="bg-gradient-to-br from-red-900 via-red-800 to-red-950">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid md:grid-cols-2 gap-8 items-center text-white">
                <div>
                    <span class="inline-block px-3 py-1 bg-yellow-400 text-red-900 text-xs font-semibold rounded mb-4">AUTHENTIC CRAFTS</span>
                    <h1 class="text-5xl font-bold mb-4">Handwoven Yakan Treasures</h1>
                    <p class="text-red-100 text-lg mb-6">Discover traditional weaving heritage from Zamboanga. Each piece tells a unique story.</p>
                    <div class="flex gap-4">
                        <a href="{{ auth()->check() ? route('products.index') : route('login.user.form') }}" class="bg-white text-red-900 px-8 py-3 rounded hover:bg-gray-100 font-medium">SHOP NOW</a>
                        <a href="#custom" class="border-2 border-white text-white px-8 py-3 rounded hover:bg-white/10 font-medium">CUSTOM ORDER</a>
                    </div>
                </div>
                <div class="relative h-96">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 via-red-400 to-red-600 rounded-lg"></div>
                </div>
            </div>
        </div>
    </section>
    {{-- Categories --}}
    <section class="py-8 bg-white border-b">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach([
                    ['name' => 'Bags', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                    ['name' => 'Textiles', 'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z'],
                    ['name' => 'Home Decor', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['name' => 'Accessories', 'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4']
                ] as $cat)
                <a href="{{ auth()->check() ? route('products.index') : route('login.user.form') }}" class="border rounded p-4 text-center hover:border-red-800 hover:shadow-md transition">
                    <svg class="w-8 h-8 mx-auto mb-2 text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $cat['icon'] }}"/>
                    </svg>
                    <p class="font-medium text-sm">{{ $cat['name'] }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Flash Sale --}}
    <section class="py-4 bg-gradient-to-r from-red-800 to-red-900 text-white">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <span class="font-bold">FLASH SALE</span>
                <span class="text-sm">Ends in: 2h 30m 45s</span>
            </div>
            <a href="{{ auth()->check() ? route('products.index') : route('login.user.form') }}" class="text-sm border border-white px-4 py-1 rounded hover:bg-white hover:text-red-900">VIEW ALL</a>
        </div>
    </section>
    {{-- Products Grid --}}
    <section id="shop" class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Featured Products</h2>
                <div class="flex gap-2">
                    <button class="px-3 py-1 border rounded text-sm hover:border-red-800">Latest</button>
                    <button class="px-3 py-1 border rounded text-sm hover:border-red-800">Price</button>
                    <button class="px-3 py-1 border rounded text-sm hover:border-red-800">Popular</button>
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach([
                    ['title' => 'Yakan Bag', 'price' => '450.00', 'sold' => '152', 'color' => 'from-pink-400 to-red-500'],
                    ['title' => 'Wall Tapestry', 'price' => '890.00', 'sold' => '89', 'color' => 'from-blue-400 to-purple-500'],
                    ['title' => 'Woven Pillow', 'price' => '250.00', 'sold' => '234', 'color' => 'from-yellow-400 to-orange-500'],
                    ['title' => 'Table Runner', 'price' => '380.00', 'sold' => '67', 'color' => 'from-green-400 to-teal-500'],
                    ['title' => 'Tote Bag', 'price' => '520.00', 'sold' => '198', 'color' => 'from-red-400 to-pink-500'],
                    ['title' => 'Blanket', 'price' => '1250.00', 'sold' => '43', 'color' => 'from-indigo-400 to-purple-500']
                ] as $product)
                <div class="bg-white border rounded hover:shadow-lg transition cursor-pointer group">
                    <div class="relative overflow-hidden aspect-square">
                        <div class="absolute inset-0 bg-gradient-to-br {{ $product['color'] }}"></div>
                        <div class="absolute top-2 left-2 bg-red-800 text-white text-xs px-2 py-1 rounded">-20%</div>
                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                            <button class="bg-white p-2 rounded-full shadow hover:bg-red-50">
                                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-3">
                        <h3 class="text-sm mb-1 line-clamp-2 h-10">{{ $product['title'] }}</h3>
                        <div class="flex items-baseline gap-2 mb-1">
                            <span class="text-red-900 font-bold">₱{{ $product['price'] }}</span>
                            <span class="text-xs text-gray-400 line-through">₱{{ number_format(floatval($product['price']) * 1.25, 2) }}</span>
                        </div>
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                            <span class="ml-1">4.8 | {{ $product['sold'] }} sold</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ auth()->check() ? route('products.index') : route('login.user.form') }}" class="inline-block border-2 border-red-900 text-red-900 px-8 py-3 rounded hover:bg-red-900 hover:text-white transition font-medium">
                    SEE MORE
                </a>
            </div>
        </div>
    </section>
    {{-- Custom Order Banner --}}
    <section id="custom" class="py-16 bg-gradient-to-br from-red-900 via-red-800 to-red-950 text-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">Want Something Special?</h2>
            <p class="text-xl mb-8 text-red-100">Create your custom Yakan piece with your preferred colors and patterns</p>
            <a href="{{ auth()->check() ? route('custom_orders.create') : route('login.user.form') }}" class="inline-block bg-white text-red-900 px-10 py-4 rounded font-bold hover:bg-gray-100">
                START CUSTOM ORDER
            </a>
        </div>
    </section>
    {{-- Footer --}}
    <footer class="bg-gray-900 text-white pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8 mb-8">
                <div class="col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                        </svg>
                        <span class="text-2xl font-bold">YAKAN</span>
                    </div>
                    <p class="text-sm text-gray-400 mb-4">Authentic handwoven Yakan crafts from Zamboanga City. Preserving cultural heritage through traditional weaving.</p>
                    <div class="flex gap-3">
                        <a href="#" class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center hover:bg-red-800">f</a>
                        <a href="#" class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center hover:bg-red-800">i</a>
                        <a href="#" class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center hover:bg-red-800">t</a>
                    </div>
                </div>
                
                @foreach([
                    ['title' => 'Customer Service', 'links' => ['Help Center', 'Payment Methods', 'Track Order', 'Return & Refund']],
                    ['title' => 'About', 'links' => ['About Us', 'Our Artisans', 'Terms & Conditions', 'Privacy Policy']],
                    ['title' => 'Contact', 'links' => ['Zamboanga City', 'Philippines', 'info@yakan.com', '+63 XXX XXXX']]
                ] as $section)
                <div>
                    <h4 class="font-bold mb-3 text-sm">{{ $section['title'] }}</h4>
                    <ul class="space-y-2">
                        @foreach($section['links'] as $link)
                            <li><a href="#" class="text-sm text-gray-400 hover:text-red-400">{{ $link }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
            
            <div class="border-t border-gray-700 pt-6 text-center text-sm text-gray-400">
                © 2024 Yakan. All Rights Reserved.
            </div>
        </div>
    </footer>
    {{-- Back to Top --}}
    <button id="backToTop" class="fixed bottom-6 right-6 bg-red-900 text-white p-3 rounded-full shadow-lg opacity-0 transition hover:bg-red-800 z-50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>
    <script>
        const btn = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            btn.style.opacity = window.pageYOffset > 300 ? '1' : '0';
        });
        btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
        
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();
                const target = document.querySelector(a.getAttribute('href'));
                if (target) window.scrollTo({ top: target.offsetTop - 80, behavior: 'smooth' });
            });
        });
    </script>
</body>
</html>