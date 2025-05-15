<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureFranchiseSelected
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->franchisees->count() > 1 && !session()->has('active_franchise_id')) {
            return redirect()->route('role.request')->withErrors('Please select a franchise.');
        }

        return $next($request);
    }
}
