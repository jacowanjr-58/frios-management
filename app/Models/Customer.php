<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'franchisee_id',
        'name',
        'email',
        'phone',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'zip_code',
        'notes',
    ];

    /**
     * The franchise this customer belongs to.
     */
    public function franchisee()
    {
        return $this->belongsTo(Franchisee::class);
    }

    /**
     * Invoices billed to this customer.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * POS sales associated with this customer.
     */
    public function posSales()
    {
        return $this->hasMany(PosSale::class);
    }

    /**
     * Events linked to this customer.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
