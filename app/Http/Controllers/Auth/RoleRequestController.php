<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Franchisee;

class RoleRequestController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Pull only “pending” requests that this user *could* approve
        $pending = RoleRequest::where('status', 'pending')->get()
            ->filter(fn($r) => $user->can('approve', $r));

        return view('auth.role_request', [
            'pendingRequests' => $pending,
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $availableRoles = Role::where('name', '!=', 'super_admin')->pluck('name');
        $franchisees = Franchisee::all();

        return view('auth.role_request', compact('user', 'availableRoles', 'franchisees'));
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
            'desired_role' => 'required|exists:roles,name',
            'franchisee_ids' => 'required|array|min:1',
            'franchisee_ids.*' => 'exists:franchisees,id',
        ]);

        $user = Auth::user();

        RoleRequest::updateOrCreate(
            ['user_id' => $user->id],
            [
                'desired_role' => $request->desired_role,
                'status' => 'pending',
            ]
        );

        $user->requestedFranchisees()->sync($request->franchisee_ids);
        // Need to create this route showing requested roles/franchises
        return redirect()->route('dashboard')->with('status', 'Role request submitted successfully!');
    }


    public function approve(RoleRequest $roleRequest)
    {
        $this->authorize('approve', $roleRequest);

        // Assign the role (assuming Spatie)
        $roleRequest->user->syncRoles($roleRequest->desired_role);

        $roleRequest->update(['status' => 'approved']);

        return back()->with('success', 'Role approved.');
    }


    public function reject(RoleRequest $roleRequest)
    {
        $this->authorize('approve', $roleRequest);

        $roleRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Role rejected.');
    }


}
