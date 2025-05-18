<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureFranchiseSelected
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1) Grab the authenticated user
        $user = $request->user();

        // 2) If they have exactly one franchise and haven't already got one in session, auto-set it
        if ($user
            && $user->franchisees()->count() === 1
            && ! $request->session()->has('active_franchise_id')
        ) {
            $request->session()->put(
                'active_franchise_id',
                $user->franchisees->first()->id
            );
        }

        // 3) If they have more than one franchise but no session value, redirect
        if ($user
            && $user->franchisees()->count() > 1
            && ! $request->session()->has('active_franchise_id')
        ) {
            return redirect()->route('franchise.switcher');
        }

        // 4) (Optional) If they have zero franchises, you could redirect or abort here
        // if ($user && $user->franchisees()->count() === 0) {
        //     return redirect()->route('no-franchises-setup');
        // }

        return $next($request);
    }
}


