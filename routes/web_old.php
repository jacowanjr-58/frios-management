<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FranchiseeController;
use App\Http\Controllers\InventoryLocationController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CaseBatchController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\FlavorCategoryController;
use App\Http\Controllers\FlavorCategoryOptionController;
use App\Http\Controllers\RestockOrderController;
use App\Http\Controllers\RestockOrderItemController;
use App\Http\Controllers\AdditionalChargeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\PosSaleController;
use App\Http\Controllers\PosSaleItemController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FranchiseSwitchController;
use App\Http\Controllers\Dashboard\SuperDashboardController;
use App\Http\Controllers\Dashboard\CorporateDashboardController;
use App\Http\Controllers\Dashboard\FranchiseDashboardController;
use App\Http\Controllers\Dashboard\ManagerDashboardController;
use App\Http\Controllers\Dashboard\StaffDashboardController;

use App\Http\Controllers\SocialPostController;
use App\Http\Controllers\InstagramOnboardingController;
use App\Http\Livewire\SocialPostScheduler;
use App\Http\Controllers\PermissionMatrixController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\RoleRequestController;
use Laravel\Socialite\Facades\Socialite;



Route::middleware(['web'])->group(function () {

    //if I want to skip initial Google click page
    // Route::get('/login', fn() => redirect()->route('auth.google.redirect'));
    Route::get('/auth/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google.redirect');
    Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});



Route::middleware(['auth', 'franchise.selected'])->group(function () {

    Route::get('/dashboard/super', [SuperDashboardController::class, 'index'])->name('dashboard.super');
    Route::get('/dashboard/corporate', [CorporateDashboardController::class, 'index'])->name('dashboard.corporate');
    Route::get('/dashboard/franchise', [FranchiseDashboardController::class, 'index'])->name('dashboard.franchise');
    Route::get('/dashboard/manager', [ManagerDashboardController::class, 'index'])->name('dashboard.manager');
    Route::get('/dashboard/staff', [StaffDashboardController::class, 'index'])->name('dashboard.staff');

    Route::post('/franchise/switch', [FranchiseSwitchController::class, 'switch'])->name('franchise.switch');


    // Bulk-register all your resource controllers
    Route::resources([
        'users'               => UserController::class,
        'franchisees'         => FranchiseeController::class,
        'locations'           => InventoryLocationController::class,
        'inventories'         => InventoryController::class,
        'case-batches'        => CaseBatchController::class,
        'flavors'             => FlavorController::class,
        'flavor-categories'   => FlavorCategoryController::class,
        'flavor-options'      => FlavorCategoryOptionController::class,
        'restock-orders'      => RestockOrderController::class,
        'restock-items'       => RestockOrderItemController::class,
        'additional-charges'  => AdditionalChargeController::class,
        'invoices'            => InvoiceController::class,
        'invoice-items'       => InvoiceItemController::class,
        'pos-sales'           => PosSaleController::class,
        'pos-items'           => PosSaleItemController::class,
        'events'              => EventController::class,
    ]);

    // Social Posts CRUD
    Route::get('social-posts',          [SocialPostController::class, 'index'])->name('social_posts.index');
    Route::get('social-posts/create',   [SocialPostController::class, 'create'])->name('social_posts.create');
    Route::post('social-posts',         [SocialPostController::class, 'store'])->name('social_posts.store');

    // Instagram OAuth Onboarding
    Route::get('instagram/redirect',    [InstagramOnboardingController::class, 'redirect'])->name('instagram.redirect');
    Route::get('instagram/callback',    [InstagramOnboardingController::class, 'callback'])->name('instagram.callback');

    // show the Livewire scheduler in a simple Blade wrapper
    Route::get('schedule-post', function () {return view('schedule-post'); })->middleware('auth')->name('schedule.post');


    Route::get('/permissions', [PermissionMatrixController::class, 'index'])->name('permissions');
    Route::get('/permissions/user/{user}', [PermissionMatrixController::class, 'userPermissions']);
    Route::post('/permissions/update-matrix', [PermissionMatrixController::class, 'update']);


    Route::get('/role/approvals', [RoleRequestController::class, 'index'])->name('role.approvals');
    Route::get('/role/request', [RoleRequestController::class, 'showRequestForm'])->name('role.request');
    Route::post('/role/request', [RoleRequestController::class, 'store'])->name('role.request.submit');
});







