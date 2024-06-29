<?php

namespace Database\Factories;

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
        $imageUrls = [
            'https://porcagames.com/img/games-popular/popular-5.png',
            'https://porcagames.com/img/games-popular/popular-6.png',
            'https://porcagames.com/img/games-popular/popular-7.png',
        ];
        return [
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 5, 100),
            'image_url' => $this->faker->randomElement($imageUrls),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
