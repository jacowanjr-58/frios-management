<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchisee extends Model
{
    /** @use HasFactory<\Database\Factories\FranchiseeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address_line1','address_line2','city','state','zip',
        'contact_name','contact_email','contact_phone',
        'subscription_status','stripe_connect_account_id',
    ];

    public function inventoryLocations()
    {
        return $this->hasMany(InventoryLocation::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function restockOrders()
    {
        return $this->hasMany(RestockOrder::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function users()
    {
       return $this->belongsToMany(\App\Models\User::class, 'franchise_user');
    }
    // ...and any other relationships you need
}

