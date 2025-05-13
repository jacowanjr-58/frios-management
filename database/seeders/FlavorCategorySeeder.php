<?php

namespace Database\Seeders;


use App\Models\FlavorCategory;
use Illuminate\Database\Seeder;

class FlavorCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Availability' => ['Seasonal', 'Special', 'Steady Eddies', 'Rotating Rhonda'],
            'Flavor'       => ['Creamy', 'Fruity', 'No Sugar added', 'Gluten free', 'Dye Free', 'Vegan', 'Protein'],
            'Allergen'     => ['Nut free', 'Wheat free', 'Soy free', 'Dairy Free'],
        ];

        foreach ($categories as $name => $options) {
            $cat = FlavorCategory::updateOrCreate(
                ['name' => $name],
                ['sort_order' => 0]
            );

            foreach ($options as $idx => $optName) {
                $cat->options()->updateOrCreate(
                    ['name' => $optName],
                    ['sort_order' => $idx]
                );
            }
        }
    }
}
