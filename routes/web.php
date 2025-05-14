<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionMatrixController;
use App\Http\Controllers\Auth\GoogleLoginController;

Route::get('/auth/google/redirect', [GoogleLoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::middleware(['auth'])->group(function () {
    Route::get('/permissions', [PermissionMatrixController::class, 'index'])->name('permissions');
    Route::get('/permissions/user/{user}', [PermissionMatrixController::class, 'userPermissions']);
    Route::post('/permissions/update-matrix', [PermissionMatrixController::class, 'update']);
});
