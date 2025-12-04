<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // ==========================
    // API LOGIN
    // ==========================
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            // Try authenticating user
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'message' => 'Invalid email or password'
                ], 401);
            }

            $user = Auth::user();

            if (!$user) {
                Log::error("Auth::user() returned null", [
                    "input" => $request->all()
                ]);

                return response()->json([
                    'message' => 'User not found'
                ], 500);
            }

            // Check verified email
            if (!$user->hasVerifiedEmail()) {
                return response()->json([
                    'message' => 'Please verify your email before logging in'
                ], 403);
            }

            // Sanctum Token
            $token = $user->createToken('auth_token')->plainTextToken;

            if (!$token) {
                Log::error("Token creation failed", [
                    "user" => $user
                ]);

                return response()->json([
                    'message' => 'Token generation failed'
                ], 500);
            }

            // ==========================
            // VERY IMPORTANT:
            // React Native EXPECTS:
            // response.data.data.token
            // response.data.data.user
            // ==========================

            return response()->json([
                'message' => 'Login successful',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Login API Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);

            return response()->json([
                'message' => 'Server error, check logs'
            ], 500);
        }
    }

    // ==========================
    // API LOGOUT
    // ==========================
    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete(); // logout: delete all tokens
        }

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }
}
