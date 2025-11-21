<nav x-data="{ open: false, scrolled: false }" 
     x-init="window.addEventListener('scroll', () => { scrolled = window.pageYOffset > 20 })"
     :class="scrolled ? 'shadow-lg' : 'shadow-sm'"
     class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200 transition-all duration-300">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">

            <!-- Left Section -->
            <div class="flex items-center space-x-8">
                
                <!-- Logo with Animation -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-500 to-red-600 rounded-lg blur-sm group-hover:blur-md transition-all opacity-50 group-hover:opacity-75"></div>
                        <div class="relative bg-gradient-to-br from-red-800 to-red-900 p-2 rounded-lg shadow-lg group-hover:scale-105 transition-transform">
                            <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 18c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-2xl font-bold tracking-wider bg-gradient-to-r from-red-800 to-red-900 bg-clip-text text-transparent">
                        YAKAN
                    </span>
                </a>

                <!-- Desktop Navigation with Hover Effects -->
                <div class="hidden lg:flex space-x-2">
                    <a href="{{ route('dashboard') }}" 
                       class="relative px-4 py-2 text-gray-700 hover:text-red-800 font-medium transition-colors group">
                        <span class="relative z-10">Dashboard</span>
                        <span class="absolute inset-0 bg-red-50 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-200"></span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-800 group-hover:w-full transition-all duration-300"></span>
                    </a>

                    <a href="{{ route('products.index') }}" 
                       class="relative px-4 py-2 text-gray-700 hover:text-red-800 font-medium transition-colors group">
                        <span class="relative z-10">Products</span>
                        <span class="absolute inset-0 bg-red-50 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-200"></span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-800 group-hover:w-full transition-all duration-300"></span>
                    </a>

                    <a href="{{ route('custom_orders.index') }}" 
                       class="relative px-4 py-2 text-gray-700 hover:text-red-800 font-medium transition-colors group">
                        <span class="relative z-10">Custom Orders</span>
                        <span class="absolute inset-0 bg-red-50 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-200"></span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-800 group-hover:w-full transition-all duration-300"></span>
                    </a>

                    <a href="{{ route('cart.index') }}" 
                       class="relative px-4 py-2 text-gray-700 hover:text-red-800 font-medium transition-colors group flex items-center gap-2">
                        <span class="relative z-10 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Cart
                            @if(isset($cartCount) && $cartCount > 0)
                                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center animate-pulse">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </span>
                        <span class="absolute inset-0 bg-red-50 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-200"></span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-800 group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>
            </div>

            <!-- Right: Profile & Actions -->
            <div class="hidden lg:flex items-center space-x-4">
                
                <!-- Notifications Bell -->
                <button class="relative p-2 text-gray-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-600 rounded-full"></span>
                </button>

                <!-- Profile Dropdown -->
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-700 hover:text-red-800 hover:bg-red-50 transition-all group border border-transparent hover:border-red-200">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="text-left hidden xl:block">
                                    <div class="font-semibold text-sm">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4 opacity-60 group-hover:opacity-100 transition-opacity" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" 
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" 
                                    clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <div class="font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="py-2">
                            <x-dropdown-link href="{{ route('dashboard') }}" class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Dashboard
                            </x-dropdown-link>

                            <x-dropdown-link href="{{ route('profile.edit') }}" class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                My Profile
                            </x-dropdown-link>

                            <x-dropdown-link href="{{ route('custom_orders.index') }}" class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                My Orders
                            </x-dropdown-link>
                        </div>

                        <div class="border-t border-gray-100 py-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link 
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center gap-2 text-red-600 hover:bg-red-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden flex items-center">
                <button @click="open = !open" 
                        class="p-2 rounded-lg text-gray-600 hover:text-red-800 hover:bg-red-50 transition-all">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'block': !open}" 
                              class="block"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16" />
                        
                        <path :class="{'hidden': !open, 'block': open}" 
                              class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" 
         x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="hidden lg:hidden border-t border-gray-200 bg-white shadow-lg">
        
        <!-- Mobile Navigation Links -->
        <div class="py-4 space-y-1 px-4">
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:text-red-800 hover:bg-red-50 transition-all font-medium group">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('products.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:text-red-800 hover:bg-red-50 transition-all font-medium group">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Products
            </a>

            <a href="{{ route('custom_orders.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:text-red-800 hover:bg-red-50 transition-all font-medium group">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Custom Orders
            </a>

            <a href="{{ route('cart.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:text-red-800 hover:bg-red-50 transition-all font-medium group relative">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Cart
                @if(isset($cartCount) && $cartCount > 0)
                    <span class="ml-auto bg-red-600 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
        </div>

        <!-- Mobile Profile Section -->
        <div class="border-t border-gray-200 py-4 px-4 bg-gray-50">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold shadow-md text-lg">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="text-gray-900 font-semibold">{{ Auth::user()->name }}</div>
                    <div class="text-gray-500 text-sm">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link href="{{ route('profile.edit') }}" class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    My Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link 
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="flex items-center gap-2 text-red-600 hover:bg-red-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Add spacing after fixed nav -->
<div class="h-20"></div>

<style>
    /* Custom Navigation Styles */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    nav [x-show="open"] {
        animation: slideDown 0.2s ease-out;
    }

    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Custom scrollbar for dropdown */
    .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }

    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>