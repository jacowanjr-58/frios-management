<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FranchiseSwitchController extends Controller
{
    public function switch(Request $request)
    {
        $request->validate([
            'franchise_id' => 'required|exists:franchisees,id',
        ]);

        Session::put('active_franchise_id', $request->franchise_id);

        return redirect()->back()->with('status', 'Franchise switched!');
    }
}
