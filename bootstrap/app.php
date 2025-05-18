<?php

use Illuminate\Foundation\Application;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;


use App\Http\Middleware\CheckUserSetup;
use App\Http\Middleware\EnsureFranchiseSelected;

use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(
    basePath: dirname(__DIR__)
)
->withRouting(
    web:      __DIR__ . '/../routes/web.php',
    api:      __DIR__ . '/../routes/api.php',
    commands: __DIR__ . '/../routes/console.php',
    health:   '/up',
)
->withMiddleware(function ($middleware) {
    // 1) Alias your route‐level middleware
    $middleware->alias([
        'role'               => RoleMiddleware::class,
        'permission'         => PermissionMiddleware::class,
        'role_or_permission' => RoleOrPermissionMiddleware::class,
        'franchise.selected' => EnsureFranchiseSelected::class,
        'user_setup'         => CheckUserSetup::class,
    ]);

    // 2) Define the "web" group that applies to all routes in routes/web.php
    $middleware->group('web', [
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        SubstituteBindings::class,
        VerifyCsrfToken::class,
    ]);
})
->withExceptions(function ($exceptions) {
    //
})
->create();
