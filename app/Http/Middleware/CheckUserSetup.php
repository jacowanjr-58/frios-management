<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserSetup
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1) If no user, skip
        if (! Auth::check()) {
            return $next($request);
        }

        // 2) If we’re already on the role‐request page, skip
        if ($request->routeIs('role.request', 'role.request.store')) {
            return $next($request);
        }

        // 3) Now do your normal check
        $user = Auth::user();

        if ($user->roles->isEmpty() || $user->franchisees->isEmpty()) {
            return redirect()->route('role.request');
        }

        return $next($request);
    }
}
