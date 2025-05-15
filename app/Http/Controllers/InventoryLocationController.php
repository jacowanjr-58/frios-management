<?php

namespace App\Http\Controllers;

use App\Models\InventoryLocation;
use App\Models\Franchisee;
use App\Http\Requests\StoreInventoryLocationRequest;
use App\Http\Requests\UpdateInventoryLocationRequest;
use Illuminate\Support\Facades\Auth;

class InventoryLocationController extends FranchiseScopedController
{
    /**
     * Display a listing of inventory locations.
     */
    public function index()
    {
        $query = InventoryLocation::query();

        // Franchise admins see only their own franchise locations
        if (Auth::user()->role === 'franchise_admin') {
            $query->Inventory::whereIn('franchisee_id', Auth::user()->franchises->pluck('id'))->get();
        }

        $locations = $query->paginate(20);
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new inventory location.
     */
    public function create()
    {
        $franchises = Franchisee::orderBy('name')->get();
        return view('locations.create', compact('franchises'));
    }

    /**
     * Store a newly created inventory location in storage.
     */
    public function store(StoreInventoryLocationRequest $request)
    {
        $data = $request->validated();
        InventoryLocation::create($data);

        return redirect()->route('locations.index')
                         ->with('success', 'Inventory location created successfully.');
    }

    /**
     * Display the specified inventory location.
     */
    public function show(InventoryLocation $inventoryLocation)
    {
        return view('locations.show', compact('inventoryLocation'));
    }

    /**
     * Show the form for editing the specified inventory location.
     */
    public function edit(InventoryLocation $inventoryLocation)
    {
        $franchises = Franchisee::orderBy('name')->get();
        return view('locations.edit', compact('inventoryLocation', 'franchises'));
    }

    /**
     * Update the specified inventory location in storage.
     */
    public function update(UpdateInventoryLocationRequest $request, InventoryLocation $inventoryLocation)
    {
        $inventoryLocation->update($request->validated());

        return redirect()->route('locations.index')
                         ->with('success', 'Inventory location updated successfully.');
    }

    /**
     * Remove the specified inventory location from storage.
     */
    public function destroy(InventoryLocation $inventoryLocation)
    {
        $inventoryLocation->delete();

        return redirect()->route('locations.index')
                         ->with('success', 'Inventory location deleted successfully.');
    }
}
