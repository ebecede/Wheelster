<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
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
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(640, 480, 'cars', true),
            'price' => $this->faker->randomFloat(2, 1000000, 5000000),
            'stock' => $this->faker->numberBetween(1, 100),
        ];
    }
}
