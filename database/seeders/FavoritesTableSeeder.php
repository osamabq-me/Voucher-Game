<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    public function run()
    {

        Favorite::create([
            'id_user' => 1,
            'id_product' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Favorite::create([
            'id_user' => 1,
            'id_product' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Favorite::create([
            'id_user' => 1,
            'id_product' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Favorite::factory()->count(100)->create();
    }
}
