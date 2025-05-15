<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureFranchiseSelected;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| These routes are grouped by authentication, franchise selection, and role.
*/

// Google Auth Routes
Route::get('/auth/google/redirect', [App\Http\Controllers\Auth\GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleLoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::get('/login', fn() => redirect()->route('auth.google.redirect'))->name('login');



Route::middleware(['auth', 'verified'])->group(function () {

    // Role Request and Approval Flow
    Route::get('/role/request', [App\Http\Controllers\Auth\RoleRequestController::class, 'create'])->name('role.request');
    Route::post('/role/request', [App\Http\Controllers\Auth\RoleRequestController::class, 'store'])->name('role.request.store');
    Route::get('/role/approvals', [App\Http\Controllers\Auth\RoleRequestController::class, 'index'])->name('role.approvals');
    Route::post('/role/approvals/{request}/approve', [App\Http\Controllers\Auth\RoleRequestController::class, 'approve'])->name('role.approvals.approve');
    Route::post('/role/approvals/{request}/reject', [App\Http\Controllers\Auth\RoleRequestController::class, 'reject'])->name('role.approvals.reject');

    // Franchise-scoped logic
    Route::middleware(['franchise.selected'])->group(function () {

        // Shared Dashboard Route
        //Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

        // Super Admin Dashboard
        Route::middleware(['role:super_admin'])->group(function () {
            Route::get('/dashboard/super', [App\Http\Controllers\Dashboard\SuperDashboardController::class, 'index'])->name('dashboard.super');
        });

        // Corporate Admin
        Route::middleware(['role:corporate_admin'])->group(function () {
            Route::resource('franchisees', App\Http\Controllers\FranchiseeController::class);
            Route::get('/dashboard/corporate', [App\Http\Controllers\Dashboard\CorporateDashboardController::class, 'index'])->name('dashboard.corporate');
        });

        // Franchise Admin + Manager
        Route::middleware(['role:franchise_admin|franchise_manager'])->group(function () {
            Route::resource('inventories', App\Http\Controllers\InventoryController::class);
            Route::resource('events', App\Http\Controllers\EventController::class);
            Route::get('/dashboard/franchise', [App\Http\Controllers\Dashboard\FranchiseDashboardController::class, 'index'])->name('dashboard.franchise');
        });

        // Franchise Staff
        Route::middleware(['role:franchise_staff'])->group(function () {
            Route::get('/dashboard/staff', [App\Http\Controllers\Dashboard\StaffDashboardController::class, 'index'])->name('dashboard.staff');
        });

        // Global shared resources
        Route::get('/permissions', [App\Http\Controllers\PermissionMatrixController::class, 'index'])->name('permissions');
        Route::post('/permissions/update-matrix', [App\Http\Controllers\PermissionMatrixController::class, 'update'])->name('permissions.update');
        Route::get('/permissions/user/{user}', [App\Http\Controllers\PermissionMatrixController::class, 'userPermissions'])->name('permissions.user');
    });
});


// Profile (Jetstream)
Route::middleware(['auth:sanctum', 'verified'])->get('/user/profile', function () {
    return view('profile.show');
})->name('profile.show');
