<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DevAuthBypass
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  public function handle(Request $request, Closure $next)
{
    if (env('BYPASS_AUTH') === 'true' && !Auth::check()) {
        $user = User::find(env('BYPASS_USER_ID'));

        if ($user) {
            Auth::login($user);
            Log::info("DevAuthBypass: Logged in as {$user->email} ({$user->id})");
        } else {
            Log::warning("DevAuthBypass: User ID " . env('BYPASS_USER_ID') . " not found.");
        }
    }

    return $next($request);
}
}
