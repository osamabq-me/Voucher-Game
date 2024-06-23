<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Define sample products
        $products = [
            [
                'name' => 'Free Fire',
                'description' => 'Description for Free Fire',
                'price' => 10000,
                'image_url' => 'https://porcagames.com/img/games-popular/popular-5.png',
            ],
            [
                'name' => 'Genshin Impact',
                'description' => 'Description for Genshin Impact',
                'price' => 20000,
                'image_url' => 'https://porcagames.com/img/games-popular/popular-6.png',
            ],
            [
                'name' => 'Call Of Duty',
                'description' => 'Description for Call Of Duty',
                'price' => 30000,
                'image_url' => 'https://porcagames.com/img/games-popular/popular-7.png',
            ],
            // Add more products as needed
        ];

        // Insert sample products into the database
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
