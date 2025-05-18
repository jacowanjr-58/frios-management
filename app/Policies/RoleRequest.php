<?php

namespace App\Policies;

use App\Models\RoleRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoleRequestPolicy
{
    use HandlesAuthorization;

 public function approve(User $actor, RoleRequest $request)
    {
        $role    = $request->desired_role;
        $frIDs   = $actor->franchisees->pluck('id')->toArray();
        $frID    = $request->franchisee_id;

        // super_admin → corporate_admin
        if ($actor->hasRole('super_admin') && $role === 'corporate_admin') {
            return true;
        }

        // corporate_admin → franchise_admin
        if ($actor->hasRole('corporate_admin') && $role === 'franchise_admin') {
            return true;
        }

        // franchise_admin → franchise_manager (only if same franchise)
        if ($actor->hasRole('franchise_admin')
            && $role === 'franchise_manager'
            && in_array($frID, $frIDs)
        ) {
            return true;
        }

        // franchise_admin or franchise_manager → franchise_staff (same franchise)
        if ($actor->hasAnyRole(['franchise_admin','franchise_manager'])
            && $role === 'franchise_staff'
            && in_array($frID, $frIDs)
        ) {
            return true;
        }

        return false;
    }




    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RoleRequest $roleRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RoleRequest $roleRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RoleRequest $roleRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RoleRequest $roleRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RoleRequest $roleRequest): bool
    {
        return false;
    }
}
