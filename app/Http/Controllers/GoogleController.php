<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
       /** @var GoogleProvider $google */
        $google = Socialite::driver('google');

        return $google->with(['hd' => 'friospops.com'])->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();
        $email = $googleUser->getEmail();
        $domain = substr(strrchr($email, "@"), 1);

        // Allow your personal super_admin too
        if ($email !== 'jacowanjr@gmail.com' && $domain !== 'friospops.com') {
            return abort(403, 'Only friospops.com accounts allowed.');
        }

        // Find or create the user
        $user = User::firstOrCreate(
          ['email'=>$email],
          ['name'=>$googleUser->getName(),'password'=>bcrypt(str()->random(16))]
        );

        // Optionally assign a default role if new
        if (!$user->roles()->count()) {
            $user->assignRole('franchise_admin'); // or whichever default
        }

        Auth::login($user, true);

        return redirect()->intended('/');
    }
}
