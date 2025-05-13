<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price_per_case',
        'pops_per_case',
        'cost_per_case',
        'orderable',
        'image_icon_url',
        'image_nutrition_url',
        'image_marketing_url',
    ];

    /**
     * Tags (Availability, Flavor, Allergen)
     */
    public function categoryOptions()
    {
        return $this->belongsToMany(CategoryOption::class, 'flavor_category_option');
    }

    /**
     * Months available for ordering
     */
    public function orderMonths()
    {
        return $this->belongsToMany(
            \App\Models\FlavorOrderMonth::class,
            'flavor_order_month',
            'flavor_id',
            'month'
        );
    }
}
