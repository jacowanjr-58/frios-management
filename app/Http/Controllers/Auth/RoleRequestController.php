<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleRequestController extends Controller
{
    public function index()
{
    $pending = \App\Models\RoleRequest::with('user')->where('status', 'pending')->get();
    return view('auth.role_approvals', compact('pending'));
}

    public function showRequestForm()
    {
        $roles = Role::where('name', '!=', 'super_admin')->pluck('name');
        $franchisees = \App\Models\Franchisee::all();
        return view('auth.role_request', compact('roles', 'franchisees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'desired_role' => 'required|string|exists:roles,name',
            'franchisee_ids' => 'required|array|min:1',
            'franchisee_ids.*' => 'exists:franchisees,id',
        ]);

        RoleRequest::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'desired_role' => $request->desired_role,
                'franchisee_ids' => json_encode($request->franchisee_ids),
                'status' => 'pending'
            ]
        );

        return redirect('/')->with('message', 'Role request submitted and pending approval.');
    }
}
