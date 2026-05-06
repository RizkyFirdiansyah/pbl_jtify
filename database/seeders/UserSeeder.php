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

        // Atur Faker untuk dummy user tambahan jika diperlukan
        // User::factory(10)->create(['role' => 'user']);
    }
}
