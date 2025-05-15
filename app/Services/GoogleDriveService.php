<?php

namespace App\Services;

use Google_Client;
use Google_Service_Drive;

class GoogleDriveService
{
    protected Google_Service_Drive $drive;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google_drive.client_id'));
        $client->setClientSecret(config('services.google_drive.client_secret'));
        $client->setRedirectUri(config('services.google_drive.redirect'));
        $client->addScope(Google_Service_Drive::DRIVE_READONLY);

        if (session()->has('google_drive_token')) {
            $client->setAccessToken(session('google_drive_token'));
        }

        $this->drive = new Google_Service_Drive($client);
    }

    public function getMarketingFiles(): array
    {
        $folderId = config('services.google_drive.folder_id');
        $response = $this->drive->files->listFiles([
            'q' => "'{$folderId}' in parents and trashed=false",
            'fields' => 'files(id,name,webContentLink,thumbnailLink)'
        ]);

        return $response->getFiles();
    }
}
