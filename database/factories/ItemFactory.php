<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence,
            'picture' => $this->faker->imageUrl(640, 480, 'cars', true),
            'price' => $this->faker->randomFloat(2, 1000000, 5000000),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
