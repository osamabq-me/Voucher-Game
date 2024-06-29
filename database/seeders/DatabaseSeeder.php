<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class); // Example: Assuming you have a UserSeeder
        $this->call(ProductsTableSeeder::class); // Example: Assuming you have a ProductSeeder
        $this->call(FavoritesTableSeeder::class); // Example: Assuming you have a FavoriteSeeder
        $this->call(PaymentsTableSeeder::class); // Example: Assuming you have a PaymentSeeder
        $this->call(HistoryTableSeeder::class); // Example: Assuming you have a HistorySeeder
    }
}
