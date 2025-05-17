<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureFranchiseSelected
{
    public function handle(Request $request, Closure $next): Response
    {
            if ($user->franchisees->count() >= 1) {
        session(['active_franchise_id' => $user->franchisees->first()->id]);
    } elseif (! session('active_franchise_id')) {
        return redirect()->route('franchise.switcher');
    }

        return $next($request);
    }
}


