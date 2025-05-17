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
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('super_admin')) {
            $pendingRequests = RoleRequest::where('status', 'pending')->where('desired_role', 'corporate_admin')->get();
        } elseif ($user->hasRole('corporate_admin')) {
            $pendingRequests = RoleRequest::where('status', 'pending')->where('desired_role', 'franchise_admin')->get();
        } elseif ($user->hasRole('franchise_admin')) {
            $franchiseIds = $user->franchisees->pluck('id');
            $pendingRequests = RoleRequest::where('status', 'pending')
                ->whereIn('desired_role', ['franchise_manager', 'franchise_staff'])
                ->whereHas('franchisees', function ($q) use ($franchiseIds) {
                    $q->whereIn('franchisee_id', $franchiseIds);
                })->get();
        } elseif ($user->hasRole('franchise_manager')) {
            $franchiseIds = $user->franchisees->pluck('id');
            $pendingRequests = RoleRequest::where('status', 'pending')
                ->where('desired_role', 'franchise_staff')
                ->whereHas('franchisees', function ($q) use ($franchiseIds) {
                    $q->whereIn('franchisee_id', $franchiseIds);
                })->get();
        } else {
            abort(403);
        }

        return view('role_approvals', compact('pendingRequests'));
    }

    public function create()
    {
        $user = Auth::user();
        $availableRoles = Role::where('name', '!=', 'super_admin')->pluck('name');
        $franchisees = Franchisee::all();

        return view('role_request', compact('user', 'availableRoles', 'franchisees'));
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

        public function approve(RoleRequest $request)
        {
            $user = $request->user;
            $user->syncRoles([$request->desired_role]);
            $user->franchisees()->sync($request->franchisees->pluck('id'));
            $request->update(['status' => 'approved']);

            return back()->with('status', 'Approved!');
        }

        public function reject(RoleRequest $request)
        {
            $request->update(['status' => 'rejected']);
            return back()->with('status', 'Rejected.');
        }


}
