{{-- resources/views/auth/admin-login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Yakan E-commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex items-center justify-center h-screen">

    <div class="glass-effect bg-white/95 backdrop-blur-md p-10 rounded-3xl shadow-2xl w-full max-w-md animate-fade-in-up">
        <h2 class="text-3xl font-bold text-red-600 mb-6 text-center">Admin Login</h2>

        {{-- Display login errors --}}
        @if ($errors->any())
            <div class="bg-red-200 text-red-700 p-3 rounded mb-4 text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-2">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400"
                    placeholder="Enter your email"
                >
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    required 
                    class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400"
                    placeholder="Enter your password"
                >
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-xl hover:bg-red-700 transition shadow-lg hover:shadow-xl font-semibold">
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">
            Not an admin? <a href="{{ route('welcome') }}" class="text-red-600 hover:underline">Back to Home</a>
        </p>
    </div>

</body>
</html>
