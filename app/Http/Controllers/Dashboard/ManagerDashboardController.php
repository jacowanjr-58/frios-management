<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\FranchiseScopedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ManagerDashboardController extends FranchiseScopedController
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $franchiseId =  $this->getFranchiseId();

        // 🧠 Scoped model loading example:
        // $orders = \App\Models\Order::where('franchisee_id', $franchiseId)->latest()->take(10)->get();

        return view('dashboards.manager.index', compact('user', 'franchiseId'));
    }
}
