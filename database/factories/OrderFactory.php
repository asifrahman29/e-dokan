<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'coupon_code' => $this->faker->ean8,
            'order_number' => $this->faker->ean8,
            'total_price' => $this->faker->numberBetween(100, 1000),
            'shipping_address' => $this->faker->address,
            'order_date' => now(),
        ];
    }
}
