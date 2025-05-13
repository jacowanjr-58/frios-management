<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlavorCategoryOption extends Model
{
    protected $fillable = ['flavor_category_id','name','sort_order'];

    public function category()
    {
        return $this->belongsTo(FlavorCategory::class,'flavor_category_id');
    }

    /**
     * Flavors tagged with this option.
     */
    public function flavors()
    {
        return $this->belongsToMany(
            Flavor::class,
            'flavor_flavor_category_option',
            'flavor_category_option_id',
            'flavor_id'
        );
    }
}
