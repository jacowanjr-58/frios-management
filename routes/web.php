<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{FranchiseeController, InventoryController, CaseBatchController,
    FlavorController, FlavorCategoryController, FlavorCategoryOptionController,
    RestockOrderController, RestockOrderItemController, AdditionalChargeController,
    InvoiceController, InvoiceItemController,
    PosSaleController, PosSaleItemController,
    EventController, EventAllocationController, ResourceController,
    ExpenseCategoryController, ExpenseSubCategoryController, ExpenseController,
    GeneralSettingController, WorkSessionController,
    CustomerController, TerritoryZipController
};

Route::middleware(['auth'])->group(function(){
    Route::resources([
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
