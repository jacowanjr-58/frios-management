<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionMatrixController extends Controller
{
    public function superIndex()
    {
        return $this->loadViewFor('corporate_admin');
    }

    public function superUpdate(Request $request)
    {
        return $this->handleUpdate($request, 'corporate_admin');
    }

    public function corporateIndex()
    {
        return $this->loadViewFor('franchise_admin');
    }

    public function corporateUpdate(Request $request)
    {
        return $this->handleUpdate($request, 'franchise_admin');
    }

    public function franchiseIndex()
    {
        return $this->loadViewFor('franchise_manager');
    }

    public function franchiseUpdate(Request $request)
    {
        return $this->handleUpdate($request, 'franchise_manager');
    }

    public function staffIndex()
    {
        return $this->loadViewFor('franchise_staff');
    }

    public function staffUpdate(Request $request)
    {
        return $this->handleUpdate($request, 'franchise_staff');
    }

    protected function loadViewFor($roleName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.permissions.matrix', compact('role', 'permissions', 'rolePermissions'));
    }

    protected function handleUpdate(Request $request, $roleName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $permissions = $request->input('permissions', []);
        $role->syncPermissions($permissions);

        return redirect()->back()->with('success', 'Permissions updated successfully.');
    }
}
