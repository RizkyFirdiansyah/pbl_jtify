<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $authorIds = User::whereIn('role', ['admin', 'collaborator'])->pluck('id')->toArray();
        $adminId = User::where('role', 'admin')->value('id');

        $articles = [
            ['title' => 'Tips Membangun Portofolio Mahasiswa Informatika', 'status' => 'published'],
            ['title' => 'Cara Memilih Lomba yang Sesuai dengan Skill', 'status' => 'published'],
            ['title' => 'Mengatur Deadline Pendaftaran agar Tidak Terlewat', 'status' => 'published'],
            ['title' => 'Panduan Awal Mengikuti Seminar Teknologi', 'status' => 'pending_review'],
            ['title' => 'Strategi Menjaga Konsistensi Belajar di Kampus', 'status' => 'draft'],
            ['title' => 'Mengenal Jalur Beasiswa untuk Mahasiswa Aktif', 'status' => 'published'],
            ['title' => 'Menyusun CV Mahasiswa yang Menarik', 'status' => 'published'],
            ['title' => 'Kenapa Mahasiswa Perlu Aktif di Kegiatan Akademik', 'status' => 'archived'],
        ];

        foreach ($articles as $index => $article) {
            $title = $article['title'];

            Article::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'user_id' => $authorIds[$index % max(count($authorIds), 1)] ?? $adminId,
                    'title' => $title,
                    'content' => 'Konten artikel edukatif untuk halaman tips JTIFY: ' . $title . '.',
                    'poster_path' => 'articles/' . Str::slug($title) . '.jpg',
                    'status' => $article['status'],
                    'approved_by' => $article['status'] === 'published' ? $adminId : null,
                    'approved_at' => $article['status'] === 'published' ? now()->subDays($index + 1) : null,
                    'revision_notes' => $article['status'] === 'draft' ? 'Perlu penyesuaian isi.' : null,
                ]
            );
        }
    }
}