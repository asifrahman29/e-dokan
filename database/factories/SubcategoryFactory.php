<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
class SubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Subcategory::class;
    public function definition(): array
    {
        $categories = Category::all(); 
        return [
            'name' => $this->faker->unique()->word(),
            'category_id' => $categories->random()->id,
        ];
    }
}
