<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'user_id' => Order::factory(),
            'amount' => $this->faker->numberBetween(100, 1000),
            'payment_method' => $this->faker->creditCardType,
            'transaction_id' => $this->faker->ean8,
            'status' => 'pending',
            'payment_date' => now(),
        ];
    }
}
