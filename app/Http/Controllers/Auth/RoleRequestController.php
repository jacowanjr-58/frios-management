<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleRequestController extends Controller
{
    public function showRequestForm() {
        $roles = Role::where('name', '!=', 'super_admin')->pluck('name');
        $franchisees = \App\Models\Franchisee::all();
        return view('auth.role_request', compact('roles', 'franchisees'));
    }

    public function store(Request $request) {
        $request->validate([
            'desired_role' => 'required|string|exists:roles,name',
            'franchisee_ids' => 'nullable|array'
        ]);

        \App\Models\RoleRequest::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'desired_role' => $request->desired_role,
                'franchisee_ids' => json_encode($request->franchisee_ids),
                'status' => 'pending'
            ]
        );

        return redirect('/')->with('message', 'Role request submitted and pending approval.');
    }

    public function approve(\App\Models\RoleRequest $roleRequest) {
        $user = $roleRequest->user;
        $user->syncRoles([$roleRequest->desired_role]);
        $user->franchisees()->sync(json_decode($roleRequest->franchisee_ids));
        $roleRequest->status = 'approved';
        $roleRequest->save();

        return back()->with('message', 'User approved.');
    }

    public function reject(\App\Models\RoleRequest $roleRequest) {
        $roleRequest->status = 'rejected';
        $roleRequest->save();
        return back()->with('message', 'User rejected.');
    }

    public function delete(User $user) {
        $user->delete();
        return back()->with('message', 'User deleted.');
    }
}
