<?php

namespace Database\Factories;

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
            'customer_id' => factory(App\Models\User::class)->create(['role' => 'customer'])->id,
            'item_id' => factory(App\Models\Item::class)->create()->id,
            'totalPrice' => $this->faker->randomFloat(2, 50, 1000),
            'date' => $this->faker->date(),
        ];
    }
}
