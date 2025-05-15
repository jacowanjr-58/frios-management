<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionMatrixController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\RoleRequestController;
use Laravel\Socialite\Facades\Socialite;

//if I want to skip initial Google click page
// Route::get('/login', fn() => redirect()->route('auth.google.redirect'));

Route::get('/auth/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');


Route::middleware(['auth'])->group(function () {
    Route::get('/permissions', [PermissionMatrixController::class, 'index'])->name('permissions');
    Route::get('/permissions/user/{user}', [PermissionMatrixController::class, 'userPermissions']);
    Route::post('/permissions/update-matrix', [PermissionMatrixController::class, 'update']);


    Route::get('/role/approvals', [RoleRequestController::class, 'index'])->name('role.approvals');
    Route::get('/role/request', [RoleRequestController::class, 'showRequestForm'])->name('role.request');
    Route::post('/role/request', [RoleRequestController::class, 'store'])->name('role.request.submit');
});





Route::get('/test-socialite', function () {
    return Socialite::driver('google')->stateless()->redirect();
});


