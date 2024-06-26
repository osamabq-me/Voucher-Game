<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'), // Use bcrypt() for password hashing
            'is_admin' => true,
        ]);

        User::create([
            'username' => 'M Ayash',
            'email' => 'm.ayashal.f@gmail.com',
            'password' => bcrypt('password'), // Use bcrypt() for password hashing
            'is_admin' => true,
        ]);

        User::factory()->count(100)->create();
    }
}
