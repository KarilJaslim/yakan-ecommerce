<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Yakan E-commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .animate-slide-left {
            animation: slideInLeft 0.6s ease-out forwards;
        }
        
        .animate-slide-right {
            animation: slideInRight 0.6s ease-out forwards;
        }
        
        .pattern-dots {
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        .input-focus:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }
        
        .password-strength-weak { background: #ef4444; }
        .password-strength-medium { background: #f59e0b; }
        .password-strength-strong { background: #10b981; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-6xl grid lg:grid-cols-2 gap-8 items-center">
        <!-- Left Side - Registration Form -->
        <div class="w-full max-w-md mx-auto lg:order-1 animate-slide-left">
            <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100">
                <!-- Logo -->
                <div class="flex items-center justify-center space-x-3 mb-8">
                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-700 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-red-600 to-red-800 bg-clip-text text-transparent">Yakan</span>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                    <p class="text-gray-600">Join us and start shopping today</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    
                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                required 
                                autofocus
                                autocomplete="name"
                                class="input-focus w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200"
                                placeholder="John Doe"
                                value="{{ old('name') }}"
                            >
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required 
                                autocomplete="username"
                                class="input-focus w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200"
                                placeholder="you@example.com"
                                value="{{ old('email') }}"
                            >
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required 
                                autocomplete="new-password"
                                class="input-focus w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200"
                                placeholder="••••••••"
                                onkeyup="checkPasswordStrength(this.value)"
                            >
                        </div>
                        <!-- Password Strength Indicator -->
                        <div class="mt-2">
                            <div class="flex gap-1 h-1">
                                <div id="strength-1" class="flex-1 bg-gray-200 rounded-full transition-all duration-300"></div>
                                <div id="strength-2" class="flex-1 bg-gray-200 rounded-full transition-all duration-300"></div>
                                <div id="strength-3" class="flex-1 bg-gray-200 rounded-full transition-all duration-300"></div>
                                <div id="strength-4" class="flex-1 bg-gray-200 rounded-full transition-all duration-300"></div>
                            </div>
                            <p id="strength-text" class="text-xs text-gray-500 mt-1">Use 8+ characters with mix of letters, numbers & symbols</p>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                class="input-focus w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200"
                                placeholder="••••••••"
                            >
                        </div>
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="flex items-start">
                        <input type="checkbox" id="terms" required class="w-4 h-4 mt-1 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        <label for="terms" class="ml-2 text-sm text-gray-600">
                            I agree to the <a href="#" class="text-red-600 hover:text-red-700 font-semibold">Terms of Service</a> and <a href="#" class="text-red-600 hover:text-red-700 font-semibold">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-3 rounded-xl font-semibold hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    >
                        Create Account
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">Or register with</span>
                    </div>
                </div>

                <!-- Social Registration Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700">Google</span>
                    </button>
                    
                    <button class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="#1877F2" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700">Facebook</span>
                    </button>
                </div>

                <!-- Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-red-600 hover:text-red-700 font-semibold">Sign in</a>
                    </p>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="{{ route('welcome') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>

        <!-- Right Side - Benefits Section -->
        <div class="hidden lg:block lg:order-2 animate-slide-right">
            <div class="relative">
                <!-- Decorative Background -->
                <div class="absolute inset-0 bg-gradient-to-br from-red-600 to-red-800 rounded-3xl transform -rotate-3 opacity-10"></div>
                
                <div class="relative bg-gradient-to-br from-red-600 to-red-700 rounded-3xl p-12 text-white pattern-dots shadow-2xl">
                    <div class="mb-8">
                        <h2 class="text-4xl font-bold mb-4">Join Yakan Today!</h2>
                        <p class="text-red-100 text-lg">Create your account and unlock exclusive benefits</p>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4 bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-1">Exclusive Deals</h3>
                                <p class="text-red-100 text-sm">Get access to member-only discounts and special offers</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-1">Save Favorites</h3>
                                <p class="text-red-100 text-sm">Create wishlists and save your favorite products</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-1">Order Tracking</h3>
                                <p class="text-red-100 text-sm">Track your orders in real-time from purchase to delivery</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-1">Custom Orders</h3>
                                <p class="text-red-100 text-sm">Request personalized products tailored to your needs</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-1">24/7 Support</h3>
                                <p class="text-red-100 text-sm">Get help anytime with our dedicated customer service team</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 pt-8 border-t border-white/20">
                        <p class="text-center text-red-100 text-sm mb-4">Trusted by thousands of customers</p>
                        <div class="flex items-center justify-center space-x-2">
                            <div class="flex -space-x-2">
                                <div class="w-10 h-10 bg-white/30 rounded-full border-2 border-white"></div>
                                <div class="w-10 h-10 bg-white/30 rounded-full border-2 border-white"></div>
                                <div class="w-10 h-10 bg-white/30 rounded-full border-2 border-white"></div>
                                <div class="w-10 h-10 bg-white/30 rounded-full border-2 border-white"></div>
                            </div>
                            <span class="text-white font-semibold">500+ Happy Customers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkPasswordStrength(password) {
            const strength1 = document.getElementById('strength-1');
            const strength2 = document.getElementById('strength-2');
            const strength3 = document.getElementById('strength-3');
            const strength4 = document.getElementById('strength-4');
            const strengthText = document.getElementById('strength-text');
            
            // Reset
            [strength1, strength2, strength3, strength4].forEach(el => {
                el.className = 'flex-1 bg-gray-200 rounded-full transition-all duration-300';
            });
            
            if (password.length === 0) {
                strengthText.textContent = 'Use 8+ characters with mix of letters, numbers & symbols';
                strengthText.className = 'text-xs text-gray-500 mt-1';
                return;
            }
            
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            if (strength === 1) {
                strength1.className = 'flex-1 password-strength-weak rounded-full transition-all duration-300';
                strengthText.textContent = 'Weak password';
                strengthText.className = 'text-xs text-red-600 mt-1 font-semibold';
            } else if (strength === 2) {
                strength1.className = 'flex-1 password-strength-medium rounded-full transition-all duration-300';
                strength2.className = 'flex-1 password-strength-medium rounded-full transition-all duration-300';
                strengthText.textContent = 'Medium password';
                strengthText.className = 'text-xs text-orange-600 mt-1 font-semibold';
            } else if (strength === 3) {
                strength1.className = 'flex-1 password-strength-strong rounded-full transition-all duration-300';
                strength2.className = 'flex-1 password-strength-strong rounded-full transition-all duration-300';
                strength3.className = 'flex-1 password-strength-strong rounded-full transition-all duration-300';
                strengthText.textContent = 'Strong password';
                strengthText.className = 'text-xs text-green-600 mt-1 font-semibold';
            } else if (strength === 4) {
                strength1.className = 'flex-1 password-strength-strong rounded-full transition-all duration-300';
                strength2.className = 'flex-1 password-strength-strong rounded-full transition-all duration-300';
                strength3.className = 'flex-1 password-strength-strong rounded-full transition-all duration-300';
                strength4.className = 'flex-1 password-strength-strong rounded-full transition-all duration-300';
                strengthText.textContent = 'Very strong password!';
                strengthText.className = 'text-xs text-green-600 mt-1 font-semibold';
            }
        }
    </script>
</body>
</html>