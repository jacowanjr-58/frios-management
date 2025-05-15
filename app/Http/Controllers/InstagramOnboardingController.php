<?php

namespace App\Http\Controllers;

use App\Services\InstagramService;
use Illuminate\Http\Request;

class InstagramOnboardingController extends Controller
{
    public function redirect(InstagramService $ig)
    {
        return redirect($ig->getAuthUrl());
    }

    public function callback(Request $request, InstagramService $ig)
    {
        $data = $ig->handleCallback($request->code);
        session(['instagram_access_token' => $data['access_token']]);
        return redirect()->route('social_posts.create');
    }
}
