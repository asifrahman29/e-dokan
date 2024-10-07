<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->optional()->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'slug' => $this->faker->unique()->slug(),
            'product_image' => $this->faker->imageUrl(640, 480, 'products', true, 'Faker'),
            'category_id' => Category::factory(),
            'subcategory_id' => Subcategory::factory(),
            'brand_id' => Brand::factory(),
        ];
    }
}
