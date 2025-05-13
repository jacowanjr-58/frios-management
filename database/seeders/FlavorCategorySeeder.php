<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FlavorCategory;

class FlavorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

     $categories = [
            'Availability' => ['Seasonal','Special','Steady Eddies','Rotating Rhonda'],
            'Flavor'       => ['Creamy','Fruity','No Sugar added','Gluten free','Dye Free','Vegan','Protein'],
            'Allergen'     => ['Nut free','Wheat free','Soy free','Dairy Free'],
        ];

        foreach ($categories as $name => $options) {
            $cat = FlavorCategory::create([
                'name'       => $name,
                'sort_order' => 0,
            ]);

            // Create each option under this category
            foreach ($options as $idx => $optName) {
                $cat->options()->create([
                    'name'       => $optName,
                    'sort_order' => $idx,
                ]);
            }
        }



    }
}
