<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'reguler')->pluck('id')->toArray();

        $messages = [
            'Tampilan JTIFY sudah menarik dan mudah dipahami.',
            'Akan lebih baik jika ada filter tanggal pada halaman informasi.',
            'Fitur bookmark sangat membantu menyimpan informasi penting.',
            'Mohon ditambahkan notifikasi email untuk deadline pendaftaran.',
            'Konten seminar dan lomba sudah cukup lengkap.',
            'Saya ingin tampilan mobile lebih ringkas lagi.',
            'Proses login dan register berjalan lancar.',
            'Informasi beasiswa sangat membantu mahasiswa semester awal.',
        ];

        foreach ($messages as $index => $message) {
            Feedback::updateOrCreate(
                ['message' => $message],
                [
                    'user_id' => $users[$index % max(count($users), 1)],
                    'status' => match ($index % 3) {
                        0 => 'published',
                        1 => 'draft',
                        default => 'archived',
                    },
                ]
            );
        }
    }
}