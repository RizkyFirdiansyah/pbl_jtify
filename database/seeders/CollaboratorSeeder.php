<?php

namespace Database\Seeders;

use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Database\Seeder;

class CollaboratorSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = User::where('role', 'admin')->value('id');
        $users = User::where('role', 'reguler')->limit(15)->get();

        $reasons = [
            'Ingin membantu publikasi informasi lomba dan seminar.',
            'Aktif di kegiatan kampus dan siap membantu operasional konten.',
            'Tertarik menjadi pengelola konten informatif untuk mahasiswa.',
            'Ingin belajar manajemen konten dan komunikasi digital.',
            'Siap membantu moderasi data informasi kampus.',
        ];

        foreach ($users as $index => $user) {
            $status = match ($index % 3) {
                0 => 'approved',
                1 => 'pending',
                default => 'rejected',
            };

            Collaborator::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'reason' => $reasons[$index % count($reasons)],
                    'status' => $status,
                    'reviewed_by' => $status === 'pending' ? null : $adminId,
                ]
            );
        }
    }
}