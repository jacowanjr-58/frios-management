<?php

namespace App\Http\Controllers;

use App\Models\SocialPost;
use Illuminate\Http\Request;

class SocialPostController extends FranchiseScopedController
{
    public function index()
    {
        $posts = SocialPost::where('user_id', auth()->id())->get();
        return view('social_posts.index', compact('posts'));
    }

    public function create()
    {
        return view('social_posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => 'nullable|string',
            'media_url' => 'required|url',
            'scheduled_at' => 'nullable|date',
        ]);

        auth()->user()->socialPosts()->create(array_merge($data, [
            'platform' => 'instagram',
            'status' => 'scheduled',
        ]));

        return redirect()->route('social_posts.index');
    }
}
