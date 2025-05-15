<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class InstagramService
{
    public function getAuthUrl(): string
    {
        return 'https://api.instagram.com/oauth/authorize'
            .'?client_id=' . config('services.instagram.app_id')
            ."&redirect_uri=" . urlencode(config('services.instagram.redirect'))
            ."&scope=user_profile,user_media,pages_show_list,instagram_content_publish"
            ."&response_type=code";
    }

    public function handleCallback(string $code): array
    {
        $response = Http::asForm()->post('https://api.instagram.com/oauth/access_token', [
            'client_id' => config('services.instagram.app_id'),
            'client_secret' => config('services.instagram.app_secret'),
            'grant_type' => 'authorization_code',
            'redirect_uri' => config('services.instagram.redirect'),
            'code' => $code,
        ]);

        return $response->json();
    }

    public function publishPost(string $accessToken, \$post): array
    {
        return [];
    }
}
