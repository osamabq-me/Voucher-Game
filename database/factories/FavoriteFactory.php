<?php

namespace Database\Factories;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favorite>
 */
class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    public function definition()
    {

        return [
            'id_user' => rand(1, 100),
            'id_product' =>  rand(1, 100),
            'created_at' => $this->faker->unique()->dateTimeThisYear(),
            'updated_at' => now(),
        ];
    }
}
