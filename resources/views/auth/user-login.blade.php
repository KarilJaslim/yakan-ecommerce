<!-- resources/views/auth/user-login.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-6 text-center">User Login</h2>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('login.user.submit') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block mb-1 font-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block mb-1 font-medium">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <!-- Remember Me -->
        <div class="mb-4 flex items-center">
            <input id="remember" type="checkbox" name="remember" class="mr-2">
            <label for="remember">Remember Me</label>
        </div>

        <!-- Submit -->
        <div class="mb-4">
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Login
            </button>
        </div>

        <!-- Links -->
        <div class="text-center">
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
            <span class="mx-2">|</span>
            <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Forgot Password?</a>
        </div>
    </form>
</div>
@endsection
