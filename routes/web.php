<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\{FranchiseeController, InventoryController, CaseBatchController,
    FlavorController, FlavorCategoryController, FlavorCategoryOptionController,
    RestockOrderController, RestockOrderItemController, AdditionalChargeController,
    InvoiceController, InvoiceItemController,
    PosSaleController, PosSaleItemController,
    EventController, EventAllocationController, ResourceController,
    ExpenseCategoryController, ExpenseSubCategoryController, ExpenseController,
    GeneralSettingController, WorkSessionController,
    CustomerController, TerritoryZipController, UserController, InventoryLocationController, PermissionMatrixController
};


Route::get('auth/google/redirect', [GoogleController::class,'redirect']);
Route::get('auth/google/callback', [GoogleController::class,'callback']);

// Super admin can manage corporate_admin permissions
Route::middleware(['role:super_admin'])->group(function () {
    Route::get('/admin/permissions/super', [PermissionMatrixController::class, 'superIndex'])->name('permissions.super');
    Route::post('/admin/permissions/super', [PermissionMatrixController::class, 'superUpdate'])->name('permissions.super.update');
});

// Corporate admins manage franchise_admin permissions
Route::middleware(['role:corporate_admin'])->group(function () {
    Route::get('/admin/permissions/corporate', [PermissionMatrixController::class, 'corporateIndex'])->name('permissions.corporate');
    Route::post('/admin/permissions/corporate', [PermissionMatrixController::class, 'corporateUpdate'])->name('permissions.corporate.update');
});

// Franchise admins manage franchise_manager permissions
Route::middleware(['role:franchise_admin'])->group(function () {
    Route::get('/admin/permissions/franchise', [PermissionMatrixController::class, 'franchiseIndex'])->name('permissions.franchise');
    Route::post('/admin/permissions/franchise', [PermissionMatrixController::class, 'franchiseUpdate'])->name('permissions.franchise.update');
});

// Franchise admins or managers manage franchise_staff permissions
Route::middleware(['role:franchise_admin|franchise_manager'])->group(function () {
    Route::get('/admin/permissions/staff', [PermissionMatrixController::class, 'staffIndex'])->name('permissions.staff');
    Route::post('/admin/permissions/staff', [PermissionMatrixController::class, 'staffUpdate'])->name('permissions.staff.update');
});

// Route-based view for Livewire editor
Route::middleware(['auth'])->get('/admin/permissions/editor/{role}', function ($role) {
    return view('admin.permissions.index', compact('role'));
})->name('permissions.editor');


 Route::middleware(['auth','role:franchise_staff'])->group(function(){
     // franchise_staff-only routes...
 });



Route::middleware(['auth'])->group(function(){
    Route::resources([
        'users'          => UserController::class,
        'franchisees'    => FranchiseeController::class,
        'locations'      => InventoryLocationController::class,
        'inventories'    => InventoryController::class,
        'case-batches'   => CaseBatchController::class,

        'flavors'        => FlavorController::class,
        'flavor-categories' => FlavorCategoryController::class,
        'flavor-options' => FlavorCategoryOptionController::class,

        'restock-orders' => RestockOrderController::class,
        'restock-items'  => RestockOrderItemController::class,
        'additional-charges' => AdditionalChargeController::class,

        'invoices'       => InvoiceController::class,
        'invoice-items'  => InvoiceItemController::class,

        'pos-sales'      => PosSaleController::class,
        'pos-items'      => PosSaleItemController::class,

        'events'         => EventController::class,
        'allocations'    => EventAllocationController::class,
        'resources'      => ResourceController::class,

        'expense-categories'=> ExpenseCategoryController::class,
        'expense-sub-categories'=> ExpenseSubCategoryController::class,
        'expenses'       => ExpenseController::class,

        'settings'       => GeneralSettingController::class,
        'work-sessions'  => WorkSessionController::class,

        'customers'      => CustomerController::class,
        'territory-zips' => TerritoryZipController::class,
    ]);
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
