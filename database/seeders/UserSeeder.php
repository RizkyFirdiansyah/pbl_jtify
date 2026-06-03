<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Admin User
        User::create([
            'name' => 'Admin Jtify',
            'email' => 'admin@jtify.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        // Dummy User
        for ($i = 1; $i <= 30; $i++) {

            User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'reguler',
                'phone' => '08123' . rand(1000000, 9999999),
            ]);
        }

        // Dummy User
        for ($i = 1; $i <= 10; $i++) {

            User::create([
                'name' => 'Collaborator ' . $i,
                'email' => 'collaborator' . $i . '@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'collaborator',
                'phone' => '08123' . rand(1000000, 9999999),
            ]);
        }
    }
}
