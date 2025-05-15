<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    protected $fillable = [
        'user_id','platform','caption','media_url','scheduled_at','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
