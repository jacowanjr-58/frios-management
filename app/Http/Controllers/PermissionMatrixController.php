<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionMatrixController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'permissions' => 'required|array',
            'permissions.*.role' => 'required|string|exists:roles,name',
            'permissions.*.permission' => 'required|string|exists:permissions,name',
        ]);

        foreach (Role::all() as $role) {
            $newPermissions = collect($data['permissions'])
                ->where('role', $role->name)
                ->pluck('permission')
                ->toArray();

            $role->syncPermissions($newPermissions);
        }

        return response()->json(['status' => 'success']);
    }
}
