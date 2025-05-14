<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionMatrixController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view('permissions', compact('roles', 'users'));
    }

    public function userPermissions(User $user)
    {
        $permissions = Permission::pluck('name');
        $roles = Role::pluck('name');
        $userPermissions = $user->getAllPermissions()->pluck('name');
        $userRoles = $user->roles->pluck('name');

        return response()->json([
            'permissions' => $permissions,
            'roles' => $roles,
            'user_permissions' => $userPermissions,
            'user_roles' => $userRoles,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string|exists:roles,name',
            'permissions' => 'required|array',
            'permissions.*.permission' => 'required|string|exists:permissions,name',
        ]);

        $user = User::findOrFail($data['user_id']);
        $user->syncRoles([$data['role']]);
        $permissionNames = collect($data['permissions'])->pluck('permission')->unique();
        $user->syncPermissions($permissionNames);

        return response()->json(['status' => 'success']);
    }
}
