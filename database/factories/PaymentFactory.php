<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
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
        $user = User::inRandomOrder()->first();
        $product = Product::inRandomOrder()->first();

        // Ensure both user and product exist
        if (!$user || !$product) {
            throw new \Exception('No users or products found in the database. Please seed users and products first.');
        }

        return [
            'id_user' => $user->id_user,
            'id_product' => $product->id_product,
            'method' => $this->faker->randomElement(['Credit Card', 'PayPal', 'Bank Transfer']),
            'total' => $this->faker->randomFloat(2, 1, 10),
            'whatsapp' => $this->faker->phoneNumber,
            'created_at' => $this->faker->unique()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
