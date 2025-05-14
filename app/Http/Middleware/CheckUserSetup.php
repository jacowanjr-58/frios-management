<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserSetup {
    public function handle(Request $request, Closure $next) {
        $user = Auth::user();

        if (str_ends_with($user->email, '@friospops.com') && ($user->roles->isEmpty() || $user->franchisees->isEmpty())) {
            return redirect()->route('role.request');
        }

        return $next($request);
    }
}
