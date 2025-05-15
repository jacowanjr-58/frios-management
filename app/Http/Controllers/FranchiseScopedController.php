<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

/**
 * FranchiseScopedController
 * 
 * This base controller provides access to the current user's active franchise context
 * using the session('active_franchise_id') key. Extend this class in any controller
 * that handles data or business logic specific to a franchise (e.g., orders, events, inventory).
 */
class FranchiseScopedController extends BaseController
{
    /**
     * Retrieve the current franchise ID from session.
     *
     * @return int|null
     */
    protected function getFranchiseId()
    {
        return session('active_franchise_id');
    }
}
