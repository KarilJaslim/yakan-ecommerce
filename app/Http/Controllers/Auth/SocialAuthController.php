<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = $this->findOrCreateUser($googleUser, 'google');
            
            Auth::login($user, true);
            
            return redirect()->intended('/dashboard')
                ->with('status', 'Successfully logged in with Google!');
                
        } catch (Exception $e) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Failed to login with Google. Please try again.']);
        }
    }

    /**
     * Redirect to Facebook OAuth
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle Facebook OAuth callback
     */
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            
            $user = $this->findOrCreateUser($facebookUser, 'facebook');
            
            Auth::login($user, true);
            
            return redirect()->intended('/dashboard')
                ->with('status', 'Successfully logged in with Facebook!');
                
        } catch (Exception $e) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Failed to login with Facebook. Please try again.']);
        }
    }

    /**
     * Find or create user from social provider
     */
    protected function findOrCreateUser($socialUser, $provider)
    {
        // Check if user already exists with this provider ID
        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        if ($user) {
            // Update user info if needed
            $user->update([
                'avatar' => $socialUser->getAvatar(),
                'provider_token' => $socialUser->token,
            ]);
            return $user;
        }

        // Check if user exists with this email
        $existingUser = User::where('email', $socialUser->getEmail())->first();

        if ($existingUser) {
            // Link this provider to existing account
            $existingUser->update([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'provider_token' => $socialUser->token,
                'avatar' => $socialUser->getAvatar(),
            ]);
            return $existingUser;
        }

        // Create new user
        return User::create([
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'provider_token' => $socialUser->token,
            'avatar' => $socialUser->getAvatar(),
            'password' => Hash::make(Str::random(24)), // Random password for OAuth users
            'email_verified_at' => now(), // Auto-verify OAuth users
        ]);
    }
}