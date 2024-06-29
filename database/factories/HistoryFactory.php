<?php

namespace Database\Factories;

use App\Models\History;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\History>
 */
class HistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = History::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $payment = Payment::inRandomOrder()->first();

        if (!$payment) {
            throw new \Exception('No payment found in the database.');
        }

        return [
            'id_pembayaran' => $payment->id_pembayaran,
            'id_user' => $payment->id_user,
            'id_product' => $payment->id_product,
            'amount' => $payment->total, // Assuming 'total' is the correct attribute from Payment
            'created_at' => $this->faker->dateTimeBetween($payment->created_at, 'now'),
            'updated_at' => now(),
        ];
    }
}
