<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create fixed users
        foreach (['admin', 'superadmin', 'customer'] as $name) {
            User::factory()->create([
                'name' => $name,
                'email' => $name . "@gmail.com",
                'role' => $name,
                'image' => 'assets/img/' . $name . '.jpg',
                'password' => bcrypt($name . "12345"),
            ]);
        }

        User::factory(100)->create();
        // Create 15 Categories
        $categories = Category::factory(15)->create();

        // Create 30 Subcategories, associate them with random categories
        $subcategories = Subcategory::factory(30)->make()->each(function ($subcategory) use ($categories) {
            $subcategory->category_id = $categories->random()->id;
            $subcategory->save();
        });

        // Create 10 Brands
        $brands = Brand::factory(10)->create();

        // Create 200 Products, associate them with random categories, subcategories, and brands
        Product::factory(200)->make()->each(function ($product) use ($categories, $subcategories, $brands) {
            $product->category_id = $categories->random()->id;
            $product->subcategory_id = $subcategories->random()->id;
            $product->brand_id = $brands->random()->id;
            $product->save();
        });

        Supplier::factory(10)->create();
    }
}
