<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->ean8,
            'type' => $this->faker->randomElement(['fixed', 'percentage']),
            'value' => $this->faker->numberBetween(10, 100),
            'min_purchase' => $this->faker->numberBetween(10, 100),
            'max_uses' => $this->faker->numberBetween(1, 10),
            'uses' => 0,
            'start_date' => now(),
            'expiry_date' => now()->addDays(30),
        ];
    }
}
