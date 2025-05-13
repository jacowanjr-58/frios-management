<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLocation extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryLocationFactory> */
    use HasFactory;

     protected $fillable = [
        'franchisee_id',
        'name',
        'type',
    ];

    public function franchisee()
    {
        return $this->belongsTo(Franchisee::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
