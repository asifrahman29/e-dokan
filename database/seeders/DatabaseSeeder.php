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

        // Create 10 random users
        User::factory(10)->create();

        // Create 15 Categories
        Category::factory(15)->create();

        // Create 30 Subcategories
        Subcategory::factory(30)->create();

        // Create 10 Brands
        Brand::factory(10)->create();

        // Create 200 Products
        Product::factory(200)->create();

        // Create 10 Suppliers
        Supplier::factory(10)->create();
    }
}
