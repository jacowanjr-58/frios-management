@echo off
echo Creating Blade view stub directories and files...

set RESOURCES=users franchisees inventory_locations inventories case_batches flavors flavor_categories flavor_category_options restock_orders restock_order_items additional_charges invoices invoice_items pos_sales pos_sale_items events event_allocations resources expense_categories expense_sub_categories expenses settings work_sessions customers territory_zips

for %%R in (%RESOURCES%) do (
    echo Creating views for %%R...
    mkdir "resources\views\%%R" 2>nul
    (
        echo @extends('layouts.app')
        echo.
        echo @section('content')
        echo     <h1>%%~nR Index</h1>
        echo @endsection
    ) > "resources\views\%%R\index.blade.php"
    (
        echo @extends('layouts.app')
        echo.
        echo @section('content')
        echo     <h1>Create %%~nR</h1>
        echo @endsection
    ) > "resources\views\%%R\create.blade.php"
    (
        echo @extends('layouts.app')
        echo.
        echo @section('content')
        echo     <h1>Edit %%~nR</h1>
        echo @endsection
    ) > "resources\views\%%R\edit.blade.php"
    (
        echo @extends('layouts.app')
        echo.
        echo @section('content')
        echo     <h1>Show %%~nR</h1>
        echo @endsection
    ) > "resources\views\%%R\show.blade.php"
)

echo Blade view stubs created!
