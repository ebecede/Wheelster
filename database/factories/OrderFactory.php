<?php

namespace Database\Factories;

use App\Models\Product;
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
            'user_id' => User::factory()->create(['role' => 'customer'])->id, // Corrected User factory call
            'product_id' => Product::factory()->create()->id, // Corrected Product factory call
            'totalPrice' => $this->faker->randomFloat(2, 50, 1000),
            'orderDate' => $this->faker->date(),
        ];
    }
}
