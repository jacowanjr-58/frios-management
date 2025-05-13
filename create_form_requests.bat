@echo off
echo Generating all Form Request classes...

php artisan make:request StoreFranchiseeRequest
php artisan make:request UpdateFranchiseeRequest

php artisan make:request StoreInventoryLocationRequest
php artisan make:request UpdateInventoryLocationRequest

php artisan make:request StoreInventoryRequest
php artisan make:request UpdateInventoryRequest

php artisan make:request StoreCaseBatchRequest
php artisan make:request UpdateCaseBatchRequest

php artisan make:request StoreFlavorCategoryRequest
php artisan make:request UpdateFlavorCategoryRequest

php artisan make:request StoreFlavorCategoryOptionRequest
php artisan make:request UpdateFlavorCategoryOptionRequest

php artisan make:request StoreFlavorRequest
php artisan make:request UpdateFlavorRequest

php artisan make:request StoreRestockOrderRequest
php artisan make:request UpdateRestockOrderRequest

php artisan make:request StoreRestockOrderItemRequest
php artisan make:request UpdateRestockOrderItemRequest

php artisan make:request StoreAdditionalChargeRequest
php artisan make:request UpdateAdditionalChargeRequest

php artisan make:request StoreInvoiceRequest
php artisan make:request UpdateInvoiceRequest

php artisan make:request StoreInvoiceItemRequest
php artisan make:request UpdateInvoiceItemRequest

php artisan make:request StorePosSaleRequest
php artisan make:request UpdatePosSaleRequest

php artisan make:request StorePosSaleItemRequest
php artisan make:request UpdatePosSaleItemRequest

php artisan make:request StoreEventRequest
php artisan make:request UpdateEventRequest

php artisan make:request StoreEventAllocationRequest
php artisan make:request UpdateEventAllocationRequest

php artisan make:request StoreResourceRequest
php artisan make:request UpdateResourceRequest

php artisan make:request StoreExpenseCategoryRequest
php artisan make:request UpdateExpenseCategoryRequest

php artisan make:request StoreExpenseSubCategoryRequest
php artisan make:request UpdateExpenseSubCategoryRequest

php artisan make:request StoreExpenseRequest
php artisan make:request UpdateExpenseRequest

php artisan make:request StoreGeneralSettingRequest
php artisan make:request UpdateGeneralSettingRequest

php artisan make:request StoreWorkSessionRequest
php artisan make:request UpdateWorkSessionRequest

php artisan make:request StoreCustomerRequest
php artisan make:request UpdateCustomerRequest

php artisan make:request StoreTerritoryZipRequest
php artisan make:request UpdateTerritoryZipRequest

echo All Form Request classes generated.
