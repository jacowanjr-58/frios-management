<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CorporateDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $franchiseId = session('active_franchise_id');

        // 🧠 Scoped model loading example:
        // $orders = \App\Models\Order::where('franchisee_id', $franchiseId)->latest()->take(10)->get();

        return view('dashboards.corporate.index', compact('user', 'franchiseId'));
    }
}
