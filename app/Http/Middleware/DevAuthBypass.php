<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DevAuthBypass
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // only when BYPASS_AUTH=true in your .env
        if (env('BYPASS_AUTH', false)) {
            Auth::loginUsingId((int) env('BYPASS_USER_ID', 1));
        }

        return $next($request);
    }
}
