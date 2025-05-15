<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\GoogleDriveService;

class SocialPostScheduler extends Component
{
    public $files = [];
    public $caption = '';
    public $selectedUrl = null;
    public $scheduledAt;

    public function mount(GoogleDriveService $drive)
    {
        $this->files = $drive->getMarketingFiles();
    }

    public function select($url)
    {
        $this->selectedUrl = $url;
    }

    public function schedule()
    {
        $this->validate([
            'selectedUrl' => 'required|string',
            'scheduledAt' => 'nullable|date',
        ]);

        \App\Models\SocialPost::create([
            'user_id' => auth()->id(),
            'platform' => 'instagram',
            'media_url' => $this->selectedUrl,
            'caption' => $this->caption,
            'scheduled_at' => $this->scheduledAt,
            'status' => 'scheduled',
        ]);

        session()->flash('message', 'Post scheduled!');
    }

    public function render()
    {
        return view('livewire.social-post-scheduler');
    }
}
