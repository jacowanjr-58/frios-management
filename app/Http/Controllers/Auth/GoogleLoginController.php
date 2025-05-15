<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        // Do NOT use stateless() here — we need to store the OAuth state
       Log::info('🔥 redirectToGoogle reached');
    return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // ✅ Use stateless() ONLY here (local dev convenience)
        $googleUser = env('APP_ENV') === 'local' || env('BYPASS_AUTH') === 'true'
            ? Socialite::driver('google')->stateless()->user()
            : Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'email_verified_at' => now(),
                'password' => bcrypt(uniqid()),
            ]
        );

        // 🚨 Only set role if it's not already set
        if ($user->email === 'jacowanjr@gmail.com' && !$user->hasRole('super_admin')) {
            $user->syncRoles(['super_admin']);
        }

        Auth::login($user);

        // Redirect to role request page if role or franchise is missing
        if ($user->roles->isEmpty() || $user->franchisees->isEmpty()) {
            return redirect()->route('role.request');
        }

        // Redirect logic by role
        if ($user->hasRole('super_admin')) {
            return redirect()->route('dashboard.super');
        } elseif ($user->hasRole('corporate_admin')) {
            return redirect()->route('dashboard.corporate');
        } elseif ($user->hasRole('franchise_admin')) {
            return redirect()->route('dashboard.franchise');
        } elseif ($user->hasRole('franchise_manager')) {
            return redirect()->route('dashboard.manager');
        } elseif ($user->hasRole('franchise_staff')) {
            return redirect()->route('dashboard.staff');
        }

    }
}
