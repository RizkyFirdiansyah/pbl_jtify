<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Information;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class InformationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::whereIn('role', ['admin', 'collaborator'])->pluck('id')->toArray();
        $adminId = User::where('role', 'admin')->value('id');

        $categoryMap = Category::query()->pluck('id', 'slug');

        $datasets = [
            'lomba' => [
                'UI/UX Design Challenge 2026',
                'Web Innovation Cup 2026',
                'Mobile App Hackathon 2026',
                'Data Science Competition 2026',
                'Business Plan Contest 2026',
                'Cyber Security Challenge 2026',
                'IoT Prototype Competition 2026',
                'Poster Design Contest 2026',
                'Smart Campus Innovation 2026',
                'Software Engineering Challenge 2026',
                'AI for Student Competition 2026',
                'Digital Marketing Competition 2026',
                'Game Development Challenge 2026',
                'Startup Pitch Battle 2026',
                'Creative Coding Challenge 2026',
            ],
            'seminar' => [
                'Seminar Inovasi Teknologi 2026',
                'Webinar Karier Digital 2026',
                'Seminar AI dan Machine Learning',
                'Workshop Frontend Modern',
                'Seminar Product Management',
                'Webinar Cyber Security Awareness',
                'Seminar Data Analytics for Students',
                'Workshop UI/UX Practical Session',
                'Seminar Kewirausahaan Digital',
                'Webinar Personal Branding',
                'Seminar Cloud Computing',
                'Workshop Git dan Kolaborasi Tim',
                'Seminar Public Speaking',
                'Webinar Portofolio Mahasiswa',
                'Seminar Internet of Things',
            ],
            'beasiswa' => [
                'Beasiswa Prestasi Nusantara 2026',
                'Beasiswa Bank Indonesia 2026',
                'Beasiswa KIP Kuliah Informasi',
                'Beasiswa Talenta Digital',
                'Beasiswa Cendekia Muda',
                'Beasiswa Unggulan Mahasiswa',
                'Beasiswa Bina Prestasi',
                'Beasiswa Merdeka Belajar',
                'Beasiswa Yayasan Pendidikan',
                'Beasiswa Riset Mahasiswa',
                'Beasiswa Aktivis Kampus',
                'Beasiswa Informatika Berprestasi',
                'Beasiswa Indonesia Maju',
                'Beasiswa Masa Depan Cerdas',
                'Beasiswa Sahabat Negeri',
            ],
        ];

        $dayOffset = 3;

        foreach ($datasets as $categorySlug => $titles) {
            $categoryId = $categoryMap->get($categorySlug);

            if (! $categoryId) {
                continue;
            }

            foreach ($titles as $index => $title) {
                Information::updateOrCreate(
                    [
                        'slug' => Str::slug($title),
                    ],
                    [
                        'user_id' => $users[array_rand($users)],
                        'category_id' => $categoryId,
                        'title' => $title,
                        'description' => match ($categorySlug) {
                            'lomba' => 'Kompetisi ' . strtolower($title) . ' untuk mahasiswa JTI.',
                            'seminar' => 'Agenda ' . strtolower($title) . ' untuk menambah wawasan dan skill.',
                            'beasiswa' => 'Informasi ' . strtolower($title) . ' untuk mendukung studi mahasiswa.',
                        },
                        'deadline' => now()->addDays($dayOffset + ($index * 2)),
                        'registration_link' => 'https://example.com/register/' . Str::slug($title),
                        'guidebook_link' => 'https://example.com/guide/' . Str::slug($title),
                        'poster_path' => 'posters/' . Str::slug($title) . '.jpg',
                        'status' => 'published',
                        'approved_by' => $adminId,
                        'approved_at' => now()->subDays(2 + $index),
                    ]
                );
            }
        }
    }
}