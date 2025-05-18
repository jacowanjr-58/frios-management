<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\RoleRequestController;
use App\Http\Controllers\Dashboard\SuperDashboardController;
use App\Http\Controllers\Dashboard\CorporateDashboardController;
use App\Http\Controllers\Dashboard\FranchiseDashboardController;
use App\Http\Controllers\Dashboard\StaffDashboardController;
use App\Http\Controllers\FranchiseeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PermissionMatrixController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| These routes all get the “web” middleware group (session, CSRF,  etc.)
| by virtue of your bootstrap/app.php → withMiddleware(…).
|
*/

// 1) Public / OAuth routes
Route::get('/auth/google/redirect',  [GoogleLoginController::class, 'redirectToGoogle'])
     ->name('auth.google.redirect');

Route::get('/auth/google/callback',  [GoogleLoginController::class, 'handleGoogleCallback'])
     ->name('auth.google.callback');

Route::get('/login', function () {

    if (Auth::check()) {
        // pick the dashboard that matches your user’s role:
        if (Auth::user()->hasRole('super_admin')) {
            return redirect()->route('dashboard.super');
        }
        if (Auth::user()->hasRole('corporate_admin')) {
            return redirect()->route('dashboard.corporate');
        }
        if (Auth::user()->hasAnyRole(['franchise_admin','franchise_manager'])) {
            return redirect()->route('dashboard.franchise');
        }
        if (Auth::user()->hasRole('franchise_staff')) {
            return redirect()->route('dashboard.staff');
        }

        // fallback:
        return redirect()->route('dashboard.franchise');
    }

    // 2) Not logged in yet? Send to Google
    return redirect()->route('auth.google.redirect');
})->name('login');



// ROLE REQUEST FORM (any logged‐in user needs this)
Route::middleware(['auth'])->group(function () {
    Route::get ('/role/request', [RoleRequestController::class, 'create'])
         ->name('role.request');
    Route::post('/role/request', [RoleRequestController::class, 'store'])
         ->name('role.request.store');
});

// 2) Everything else requires a logged-in user
Route::middleware(['auth', 'user_setup'])->group(function () {


    // 2b) Approvals (only those your Policy allows will actually see & act)
    Route::prefix('approvals')->name('approvals.')->group(function () {
        Route::get ('/',                       [RoleRequestController::class, 'index'])
             ->name('index');
        Route::post('{roleRequest}/approve',  [RoleRequestController::class, 'approve'])
             ->name('approve');
        Route::post('{roleRequest}/reject',   [RoleRequestController::class, 'reject'])
             ->name('reject');
    });

    // 2c) Now everything that needs an active franchise
    Route::middleware(['franchise.selected'])->group(function () {

        // Super Admin only
        Route::middleware('role:super_admin')->get(
            '/dashboard/super',
            [SuperDashboardController::class, 'index']
        )->name('dashboard.super');

        // Corporate Admin only
        Route::middleware('role:corporate_admin')->group(function () {
            Route::resource('franchisees', FranchiseeController::class);
            Route::get(
                '/dashboard/corporate',
                [CorporateDashboardController::class, 'index']
            )->name('dashboard.corporate');
        });

        // Franchise Admin + Manager
        Route::middleware('role:franchise_admin|franchise_manager')->group(function () {
            Route::resource('inventories', InventoryController::class);
            Route::resource('events',      EventController::class);
            Route::get(
                '/dashboard/franchise',
                [FranchiseDashboardController::class, 'index']
            )->name('dashboard.franchise');
        });

        // Franchise Staff only
        Route::middleware('role:franchise_staff')->get(
            '/dashboard/staff',
            [StaffDashboardController::class, 'index']
        )->name('dashboard.staff');

        // Shared permissions‐matrix UI
        Route::get(
            '/permissions',
            [PermissionMatrixController::class, 'index']
        )->name('permissions');
        Route::post(
            '/permissions/update-matrix',
            [PermissionMatrixController::class, 'update']
        )->name('permissions.update');
        Route::get(
            '/permissions/user/{user}',
            [PermissionMatrixController::class, 'userPermissions']
        )->name('permissions.user');
    });
});


// 3) (Optional) Jetstream profile
/* Route::middleware(['auth:sanctum', 'verified'])
     ->get('/user/profile', fn() => view('profile.show'))
     ->name('profile.show');
 */
