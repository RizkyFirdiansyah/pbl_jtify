<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Information;
use App\Models\Interest;
use App\Models\User;

class InformationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();

        $informations = [
            // Workshop
            [
                'user_id' => $users[array_rand($users)],
                'category_id' => 1,
                'title' => 'Workshop Laravel Dasar',
                'slug' => 'workshop-laravel-dasar',
                'description' => 'Belajar Laravel dari dasar.',
                'deadline' => now()->addDays(10),
                'registration_link' => 'https://example.com',
                'guidebook_link' => 'https://example.com',
                'poster_path' => 'posters/workshop1.jpg',
                'status' => 'published',
            ],
            [
                'user_id' => $users[array_rand($users)],
                'category_id' => 1,
                'title' => 'Workshop UI UX',
                'slug' => 'workshop-ui-ux',
                'description' => 'Belajar desain UI UX.',
                'deadline' => now()->addDays(15),
                'registration_link' => 'https://example.com',
                'guidebook_link' => 'https://example.com',
                'poster_path' => 'posters/workshop2.jpg',
                'status' => 'published',
            ],
            [
                'user_id' => $users[array_rand($users)],
                'category_id' => 1,
                'title' => 'Workshop AI',
                'slug' => 'workshop-ai',
                'description' => 'Belajar Artificial Intelligence.',
                'deadline' => now()->addDays(20),
                'registration_link' => 'https://example.com',
                'guidebook_link' => 'https://example.com',
                'poster_path' => 'posters/workshop3.jpg',
                'status' => 'published',
            ],

            // Lomba
            [
                'user_id' => $users[array_rand($users)],
                'category_id' => 2,
                'title' => 'Lomba Web Design',
                'slug' => 'lomba-web-design',
                'description' => 'Kompetisi desain website.',
                'deadline' => now()->addDays(12),
                'registration_link' => 'https://example.com',
                'guidebook_link' => 'https://example.com',
                'poster_path' => 'posters/lomba1.jpg',
                'status' => 'published',
            ],
            [
                'user_id' => $users[array_rand($users)],
                'category_id' => 2,
                'title' => 'Lomba Mobile App',
                'slug' => 'lomba-mobile-app',
                'description' => 'Kompetisi aplikasi mobile.',
                'deadline' => now()->addDays(18),
                'registration_link' => 'https://example.com',
                'guidebook_link' => 'https://example.com',
                'poster_path' => 'posters/lomba2.jpg',
                'status' => 'published',
            ],
            [
                'user_id' => $users[array_rand($users)],
                'category_id' => 2,
                'title' => 'Lomba Data Science',
                'slug' => 'lomba-data-science',
                'description' => 'Kompetisi data science.',
                'deadline' => now()->addDays(25),
                'registration_link' => 'https://example.com',
                'guidebook_link' => 'https://example.com',
                'poster_path' => 'posters/lomba3.jpg',
                'status' => 'published',
            ],

            // Beasiswa
            [
                'user_id' => $users[array_rand($users)],
                'category_id' => 3,
                'title' => 'Beasiswa Prestasi',
                'slug' => 'beasiswa-prestasi',
                'description' => 'Beasiswa untuk mahasiswa berprestasi.',
                'deadline' => now()->addDays(30),
                'registration_link' => 'https://example.com',
                'guidebook_link' => 'https://example.com',
                'poster_path' => 'posters/beasiswa1.jpg',
                'status' => 'published',
            ],
            [
                'user_id' => $users[array_rand($users)],
                'category_id' => 3,
                'title' => 'Beasiswa KIP',
                'slug' => 'beasiswa-kip',
                'description' => 'Program bantuan pendidikan.',
                'deadline' => now()->addDays(35),
                'registration_link' => 'https://example.com',
                'guidebook_link' => 'https://example.com',
                'poster_path' => 'posters/beasiswa2.jpg',
                'status' => 'published',
            ],
            [
                'user_id' => $users[array_rand($users)],
                'category_id' => 3,
                'title' => 'Beasiswa Bank Indonesia',
                'slug' => 'beasiswa-bank-indonesia',
                'description' => 'Beasiswa dari Bank Indonesia.',
                'deadline' => now()->addDays(40),
                'registration_link' => 'https://example.com',
                'guidebook_link' => 'https://example.com',
                'poster_path' => 'posters/beasiswa3.jpg',
                'status' => 'published',
            ],
        ];

        foreach ($informations as $info) {
            Information::create($info);
        }
    }
}