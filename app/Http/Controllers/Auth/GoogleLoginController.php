<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
       // $googleUser = Socialite::driver('google')->user();
       $googleUser = Socialite::driver('google')->stateless()->user();



        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'email_verified_at' => now(),
                'password' => bcrypt(uniqid()),
            ]
        );

        // Automatically assign super_admin if it's the owner's email
        if ($user->email === 'jacowanjr@gmail.com') {
            $user->syncRoles(['super_admin']);
        }

        Auth::login($user);

        // If no roles or franchises assigned, redirect to role request
        if ($user->roles->isEmpty() || $user->franchisees->isEmpty()) {
            return redirect()->route('role.request');
        }

        return redirect()->intended('/');
    }
}
