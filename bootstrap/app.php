<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Middleware\DevAuthBypass;  // ← import your middleware
use App\Http\Middleware\EnsureFranchiseSelected;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Alias the Spatie role middleware
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'franchise.selected' => EnsureFranchiseSelected::class,
        ]);

        return [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,

            \Illuminate\Routing\Middleware\SubstituteBindings::class,

            // ✅ Place your custom middleware **after session is available**
            \App\Http\Middleware\DevAuthBypass::class,
            \App\Http\Middleware\CheckUserSetup::class,
        ];
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

