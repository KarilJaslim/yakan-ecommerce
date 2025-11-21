{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yakan - Traditional Crafts Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .font-display {
            font-family: 'Playfair Display', serif;
        }
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
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .animate-slide-in-left {
            animation: slideInLeft 0.8s ease-out forwards;
        }
        .delay-100 { animation-delay: 0.1s; opacity: 0; }
        .delay-200 { animation-delay: 0.2s; opacity: 0; }
        .delay-300 { animation-delay: 0.3s; opacity: 0; }
        .delay-400 { animation-delay: 0.4s; opacity: 0; }
        .delay-500 { animation-delay: 0.5s; opacity: 0; }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .pattern-bg {
            background-image: 
                linear-gradient(30deg, #991b1b 12%, transparent 12.5%, transparent 87%, #991b1b 87.5%, #991b1b),
                linear-gradient(150deg, #991b1b 12%, transparent 12.5%, transparent 87%, #991b1b 87.5%, #991b1b),
                linear-gradient(30deg, #991b1b 12%, transparent 12.5%, transparent 87%, #991b1b 87.5%, #991b1b),
                linear-gradient(150deg, #991b1b 12%, transparent 12.5%, transparent 87%, #991b1b 87.5%, #991b1b);
            background-size: 80px 140px;
            background-position: 0 0, 0 0, 40px 70px, 40px 70px;
            opacity: 0.05;
        }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">
    {{-- Navigation --}}
    <nav class="glass-effect fixed w-full top-0 z-50 border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3 animate-slide-in-left">
                    <div class="bg-gradient-to-br from-red-800 to-red-900 p-2 rounded-lg shadow-lg">
                        <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 18c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-wider bg-gradient-to-r from-red-800 to-red-900 bg-clip-text text-transparent">YAKAN</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-red-800 transition font-medium relative group">
                        Home
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-800 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#shop" class="text-gray-700 hover:text-red-800 transition font-medium relative group">
                        Shop
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-800 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#custom" class="text-gray-700 hover:text-red-800 transition font-medium relative group">
                        Custom Order
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-800 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#artisans" class="text-gray-700 hover:text-red-800 transition font-medium relative group">
                        Artisans
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-800 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#contact" class="text-gray-700 hover:text-red-800 transition font-medium relative group">
                        Contact
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-800 transition-all group-hover:w-full"></span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-4 animate-fade-in-up">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-red-800 transition font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-red-800 transition font-medium">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-gradient-to-r from-red-800 to-red-900 text-white px-6 py-2.5 rounded-lg hover:from-red-900 hover:to-red-800 transition font-semibold shadow-md hover:shadow-lg">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login.user.form') }}" class="text-gray-700 hover:text-red-800 transition font-medium">Login</a>
                        <a href="{{ route('login.user.form') }}" class="bg-gradient-to-r from-red-800 to-red-900 text-white px-6 py-2.5 rounded-lg hover:from-red-900 hover:to-red-800 transition font-semibold shadow-md hover:shadow-lg">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section id="home" class="relative bg-gradient-to-br from-red-900 via-red-800 to-red-950 text-white pt-32 pb-20 mt-20 overflow-hidden">
        <div class="absolute inset-0 pattern-bg"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="animate-slide-in-left">
                    <div class="inline-block mb-4 px-4 py-2 bg-yellow-400/20 rounded-full border border-yellow-400/30">
                        <span class="text-yellow-400 text-sm font-semibold">✨ Authentic Handwoven Crafts</span>
                    </div>
                    <h1 class="font-display text-5xl md:text-7xl font-bold mb-6 leading-tight">
                        TUWAS<br/>
                        <span class="text-yellow-400">YAKAN</span>
                    </h1>
                    <p class="text-xl md:text-2xl mb-4 text-red-100">weaving through generations</p>
                    <p class="text-lg text-red-200 mb-8 max-w-lg">
                        Discover the rich heritage of Yakan weaving. Each piece tells a story of tradition, artistry, and cultural pride passed down through generations.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        @auth
                            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-white text-red-900 px-8 py-4 rounded-lg hover:bg-gray-100 transition font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                SHOP NOW
                            </a>
                        @else
                            <a href="{{ route('login.user.form') }}" class="inline-flex items-center gap-2 bg-white text-red-900 px-8 py-4 rounded-lg hover:bg-gray-100 transition font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                SHOP NOW
                            </a>
                        @endauth
                        <a href="#artisans" class="inline-flex items-center gap-2 bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg hover:bg-white/10 transition font-bold text-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Learn Our Heritage
                        </a>
                    </div>
                </div>
                <div class="relative animate-fade-in-up delay-200">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <div class="flex items-center justify-between">
                            <p class="text-2xl font-bold text-red-900">₱50.00</p>
                            <button class="bg-red-900 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition text-sm font-semibold">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift border border-gray-100">
                    <div class="relative group">
                        <div class="aspect-square bg-gradient-to-br from-blue-400 to-purple-600"></div>
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-2xl text-gray-900 mb-2">Pinantupan</h3>
                        <p class="text-gray-600 mb-4">Pinantupan uses simple patterns like flowers and diamonds in elegant striped designs.</p>
                        <div class="flex items-center justify-between">
                            <p class="text-2xl font-bold text-red-900">₱50.00</p>
                            <button class="bg-red-900 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition text-sm font-semibold">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift border border-gray-100">
                    <div class="relative group">
                        <div class="aspect-square bg-gradient-to-br from-orange-400 to-red-600"></div>
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-2xl text-gray-900 mb-2">Birey - Birey</h3>
                        <p class="text-gray-600 mb-4">Birey-Birey is a traditional handwoven textile pattern that resembles rice grain sections.</p>
                        <div class="flex items-center justify-between">
                            <p class="text-2xl font-bold text-red-900">₱50.00</p>
                            <button class="bg-red-900 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition text-sm font-semibold">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                @auth
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 border-2 border-red-900 text-red-900 px-8 py-4 rounded-lg hover:bg-red-900 hover:text-white transition font-bold text-lg">
                        View Shop
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login.user.form') }}" class="inline-flex items-center gap-2 border-2 border-red-900 text-red-900 px-8 py-4 rounded-lg hover:bg-red-900 hover:text-white transition font-bold text-lg">
                        View Shop
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section id="artisans" class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-red-800 font-semibold text-sm uppercase tracking-wider">Customer Stories</span>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-gray-900 mb-4 mt-2">What Our Customers Say</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Hear from our satisfied customers about their Yakan experience</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg p-8 hover-lift border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="flex space-x-1">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6 leading-relaxed">"The quality of the Yakan weaving is absolutely stunning. Each piece tells a beautiful story!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-red-600 rounded-full mr-3"></div>
                        <div>
                            <p class="font-bold text-gray-900">Hezekiah Sarita</p>
                            <p class="text-sm text-gray-500">Traditional Yakan Blanket</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8 hover-lift border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="flex space-x-1">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6 leading-relaxed">"I love the vibrant colors and intricate patterns. Supporting these artisans feels wonderful!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-purple-600 rounded-full mr-3"></div>
                        <div>
                            <p class="font-bold text-gray-900">Maria Santos</p>
                            <p class="text-sm text-gray-500">Handwoven Tote Bag</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8 hover-lift border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="flex space-x-1">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6 leading-relaxed">"Excellent craftsmanship and fast delivery. The custom order process was seamless!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-teal-600 rounded-full mr-3"></div>
                        <div>
                            <p class="font-bold text-gray-900">Juan Dela Cruz</p>
                            <p class="text-sm text-gray-500">Custom Table Runner</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section id="contact" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <span class="text-red-800 font-semibold text-sm uppercase tracking-wider">Let's Connect</span>
                    <h2 class="font-display text-4xl md:text-5xl font-bold text-gray-900 mb-6 mt-2">Get in Touch</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Have questions about our products or want to learn more about Yakan weaving? We'd love to hear from you.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-red-100 rounded-xl p-3 flex-shrink-0">
                                <svg class="w-6 h-6 text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">Address</h3>
                                <p class="text-gray-600">Upper Calarian, Zamboanga City, Philippines</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-red-100 rounded-xl p-3 flex-shrink-0">
                                <svg class="w-6 h-6 text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">Email</h3>
                                <p class="text-gray-600">info@tuwasyakan.com</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-red-100 rounded-xl p-3 flex-shrink-0">
                                <svg class="w-6 h-6 text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">Phone</h3>
                                <p class="text-gray-600">+63 XXX XXX XXXX</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 border border-gray-200">
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                                <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-transparent transition" placeholder="John">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                                <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-transparent transition" placeholder="Doe">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Subject</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-transparent transition" placeholder="How can we help?">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                            <textarea rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-transparent transition" placeholder="Your message..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-red-800 to-red-900 text-white px-6 py-4 rounded-lg hover:from-red-900 hover:to-red-800 transition font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="bg-gradient-to-br from-red-800 to-red-900 p-2 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 18c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">YAKAN</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">Preserving traditional Yakan weaving heritage through authentic handcrafted products.</p>
                </div>
                
                <div>
                    <h4 class="font-bold text-lg mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#home" class="hover:text-yellow-400 transition">Home</a></li>
                        @auth
                            <li><a href="{{ route('products.index') }}" class="hover:text-yellow-400 transition">Shop</a></li>
                        @else
                            <li><a href="{{ route('login.user.form') }}" class="hover:text-yellow-400 transition">Shop</a></li>
                        @endauth
                        <li><a href="#custom" class="hover:text-yellow-400 transition">Custom Orders</a></li>
                        <li><a href="#artisans" class="hover:text-yellow-400 transition">Artisans</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-lg mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#contact" class="hover:text-yellow-400 transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition">FAQs</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition">Shipping Info</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition">Returns</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-lg mb-4">Contact</h4>
                    <div class="space-y-2 text-gray-400 text-sm">
                        <p>Upper Calarian</p>
                        <p>Zamboanga City, Philippines</p>
                        <p class="pt-2">info@tuwasyakan.com</p>
                        <p>+63 XXX XXX XXXX</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2024 Yakan E-commerce. All rights reserved.</p>
                    <div class="flex space-x-6 text-sm text-gray-400">
                        <a href="#" class="hover:text-yellow-400 transition">Privacy Policy</a>
                        <a href="#" class="hover:text-yellow-400 transition">Terms of Service</a>
                        <a href="#contact" class="hover:text-yellow-400 transition">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- Scroll to Top Button --}}
    <button id="scrollToTop" class="fixed bottom-8 right-8 bg-gradient-to-br from-red-800 to-red-900 text-white p-4 rounded-full shadow-xl hover:from-red-900 hover:to-red-800 transition opacity-0 pointer-events-none transform hover:scale-110 z-50">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    <script>
        // Scroll to top functionality
        const scrollBtn = document.getElementById('scrollToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollBtn.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                scrollBtn.classList.add('opacity-0', 'pointer-events-none');
            }
        });
        
        scrollBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 80; // Account for fixed navbar
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Navbar background on scroll
        const navbar = document.querySelector('nav');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 50) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
        });

        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('section > div').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html> class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <input type="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-transparent transition" placeholder="john@example.com">
                        </div>
                        
                        <div>
                            <label class="aspect-square bg-gradient-to-br from-yellow-400 via-red-400 to-red-600 rounded-2xl"></div>
                        <div class="absolute inset-0 bg-black/10"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Products --}}
    <section id="shop" class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <span class="text-red-800 font-semibold text-sm uppercase tracking-wider">Our Collection</span>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-gray-900 mb-4 mt-2">Featured Products</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Handpicked selections showcasing the finest Yakan craftsmanship</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Product Card 1 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift animate-fade-in-up delay-100 border border-gray-100">
                    <div class="relative group">
                        <div class="aspect-square bg-gradient-to-br from-pink-400 to-red-600"></div>
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all"></div>
                        <span class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">Featured</span>
                        <button class="absolute top-4 right-4 bg-white rounded-full p-2 shadow-lg hover:bg-red-50 transition transform hover:scale-110">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-gray-900 mb-2">Yakan Handwoven Bag</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Authentic handwoven bag featuring traditional Yakan patterns and vibrant colors.</p>
                        <div class="flex items-center justify-between">
                            <p class="text-2xl font-bold text-red-900">₱75.00</p>
                            <button class="bg-red-900 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition text-sm font-semibold">Add to Cart</button>
                        </div>
                    </div>
                </div>

                {{-- Product Card 2 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift animate-fade-in-up delay-200 border border-gray-100">
                    <div class="relative group">
                        <div class="aspect-square bg-gradient-to-br from-blue-400 to-purple-600"></div>
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all"></div>
                        <span class="absolute top-4 left-4 bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">Best Seller</span>
                        <button class="absolute top-4 right-4 bg-white rounded-full p-2 shadow-lg hover:bg-red-50 transition transform hover:scale-110">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-gray-900 mb-2">Traditional Tapestry</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Beautiful wall tapestry showcasing intricate geometric patterns.</p>
                        <div class="flex items-center justify-between">
                            <p class="text-2xl font-bold text-red-900">₱120.00</p>
                            <button class="bg-red-900 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition text-sm font-semibold">Add to Cart</button>
                        </div>
                    </div>
                </div>

                {{-- Product Card 3 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift animate-fade-in-up delay-300 border border-gray-100">
                    <div class="relative group">
                        <div class="aspect-square bg-gradient-to-br from-yellow-400 to-orange-600"></div>
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all"></div>
                        <button class="absolute top-4 right-4 bg-white rounded-full p-2 shadow-lg hover:bg-red-50 transition transform hover:scale-110">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-gray-900 mb-2">Yakan Woven Pillow</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Decorative pillow with traditional Yakan weaving patterns.</p>
                        <div class="flex items-center justify-between">
                            <p class="text-2xl font-bold text-red-900">₱25.00</p>
                            <button class="bg-red-900 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition text-sm font-semibold">Add to Cart</button>
                        </div>
                    </div>
                </div>

                {{-- Product Card 4 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift animate-fade-in-up delay-400 border border-gray-100">
                    <div class="relative group">
                        <div class="aspect-square bg-gradient-to-br from-green-400 to-teal-600"></div>
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all"></div>
                        <button class="absolute top-4 right-4 bg-white rounded-full p-2 shadow-lg hover:bg-red-50 transition transform hover:scale-110">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-gray-900 mb-2">Yakan Table Runner</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Elegant table runner featuring traditional handwoven patterns.</p>
                        <div class="flex items-center justify-between">
                            <p class="text-2xl font-bold text-red-900">₱45.00</p>
                            <button class="bg-red-900 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition text-sm font-semibold">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                @auth
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-red-800 to-red-900 text-white px-8 py-4 rounded-lg hover:from-red-900 hover:to-red-800 transition font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                        View All Products
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login.user.form') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-red-800 to-red-900 text-white px-8 py-4 rounded-lg hover:from-red-900 hover:to-red-800 transition font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                        View All Products
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- Custom Order CTA --}}
    <section id="custom" class="py-24 bg-gradient-to-br from-red-900 via-red-800 to-red-950 text-white relative overflow-hidden">
        <div class="absolute inset-0 pattern-bg"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="animate-fade-in-up">
                <span class="text-yellow-400 font-semibold text-sm uppercase tracking-wider">Bespoke Creations</span>
                <h2 class="font-display text-4xl md:text-5xl font-bold mb-6 mt-2">Personalise Your Weave</h2>
                <p class="text-xl text-red-100 mb-8 max-w-2xl mx-auto">
                    Create a unique piece that reflects your style. Choose your colors, patterns, and dimensions for a truly custom Yakan weaving.
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    @auth
                        <a href="{{ route('custom_orders.create') }}" class="inline-flex items-center gap-2 bg-white text-red-900 px-10 py-5 rounded-xl hover:bg-gray-100 transition font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Start Custom Order
                        </a>
                    @else
                        <a href="{{ route('login.user.form') }}" class="inline-flex items-center gap-2 bg-white text-red-900 px-10 py-5 rounded-xl hover:bg-gray-100 transition font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Start Custom Order
                        </a>
                    @endauth
                    <a href="#contact" class="inline-flex items-center gap-2 bg-transparent border-2 border-white text-white px-10 py-5 rounded-xl hover:bg-white/10 transition font-bold text-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Shop Collection --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-red-800 font-semibold text-sm uppercase tracking-wider">Traditional Patterns</span>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-gray-900 mb-4 mt-2">Shop Our Collection</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Browse our complete collection of authentic Yakan weaving products</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift border border-gray-100">
                    <div class="relative group">
                        <div class="aspect-square bg-gradient-to-br from-red-400 to-pink-600"></div>
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-2xl text-gray-900 mb-2">Saputangan</h3>
                        <p class="text-gray-600 mb-4">The Saputangan is a square piece of woven cloth featuring traditional geometric patterns in vibrant red tones.</p>
                        <div