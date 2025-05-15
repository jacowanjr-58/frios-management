<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Middleware\DevAuthBypass;  // ← import your middleware

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
        ]);

        // ① OPTION A: Add it to the 'web' group only:
        $middleware->group('web', [
            DevAuthBypass::class,
        ]);

        // — or —
        // ② OPTION B: Make it run globally on every HTTP request:
        // $middleware->global(DevAuthBypass::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

