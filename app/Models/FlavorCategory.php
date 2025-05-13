<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlavorCategory extends Model
{
    protected $fillable = ['name','sort_order'];

    /**
     * Options under this category
     * e.g. Seasonal, Special, etc.
     */
    public function options()
    {
        return $this->hasMany(FlavorCategoryOption::class);
    }
}
