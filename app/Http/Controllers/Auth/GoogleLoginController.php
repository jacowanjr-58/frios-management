<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Spatie\Permission\Models\Role;

class GoogleLoginController extends Controller
{
    protected function redirectToDashboard($user)
    {
        // 🚀 Redirect to their intended dashboard
        if ($user->hasRole('super_admin')) {
            return redirect()->route('dashboard.super');
        } elseif ($user->hasRole('corporate_admin')) {
            return redirect()->route('dashboard.corporate');
        } elseif ($user->hasRole('franchise_admin')) {
            return redirect()->route('dashboard.franchise');
        } elseif ($user->hasRole('franchise_manager')) {
            return redirect()->route('dashboard.franchise');
        } elseif ($user->hasRole('franchise_staff')) {
            return redirect()->route('dashboard.staff');
        } else {
            return redirect()->route('role.request'); // fallback
        }
    }


    public function redirectToGoogle()
    {
        // 🛠️ Dev bypass logic
    if (env('BYPASS_AUTH') === 'true' && env('BYPASS_USER_ID')) {
        $user = \App\Models\User::find(env('BYPASS_USER_ID'));

        if (! $user) {
            abort(403, 'Simulated user not found. Check BYPASS_USER_ID.');
        }

        \Illuminate\Support\Facades\Auth::login($user);
        return $this->redirectToDashboard($user);
    }

    // ✅ Real Google login
    return \Laravel\Socialite\Facades\Socialite::driver('google')
        ->with(['prompt' => 'select_account']) // Force account selection every time
        ->redirect();

    }

    public function handleGoogleCallback()
{


    // ✅ Dev Bypass Mode (Simulated user login for local testing)
    if (env('BYPASS_AUTH') === 'true' && env('BYPASS_USER_ID')) {
        $user = User::find(env('BYPASS_USER_ID'));

        if (! $user) {
            abort(403, 'Simulated user not found. Check BYPASS_USER_ID.');
        }

        Auth::login($user);
        return redirect()->intended('/');
    }

    // ✅ Real Google OAuth Flow
    $googleUser = Socialite::driver('google')->user();

    $user = User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName(),
            'email_verified_at' => now(),
            'password' => bcrypt(uniqid()),
        ]
    );

    // 🚨 Auto-assign super_admin for owner (only once)
    if ($user->email === 'jacowanjr@gmail.com' && ! $user->hasRole('super_admin')) {
        $user->syncRoles(['super_admin']);
    }

    Auth::login($user);

    // 🧠 Route to role request if user lacks role or franchise
    if ($user->roles->isEmpty() || $user->franchisees->isEmpty()) {
        return redirect()->route('role.request');
    }

     return $this->redirectToDashboard($user);

}

}
