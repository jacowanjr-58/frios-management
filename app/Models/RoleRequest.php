<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleRequest extends Model
{
    protected $fillable = ['user_id', 'desired_role', 'franchisee_ids', 'status'];

    protected $casts = [
        'franchisee_ids' => 'array', // So JSON gets auto-decoded to array
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

