<?php

namespace Database\Seeders;

use App\Models\Information;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'reguler')->pluck('id')->toArray();
        $informations = Information::query()->get();

        foreach ($informations as $index => $information) {
            if (empty($users)) {
                break;
            }

            Notification::updateOrCreate(
                [
                    'user_id' => $users[$index % count($users)],
                    'information_id' => $information->id,
                    'title' => 'Info baru: ' . $information->title,
                ],
                [
                    'message' => 'Ada informasi baru yang relevan dengan minatmu: ' . $information->title . '.',
                    'is_read' => $index % 2 === 0,
                ]
            );
        }
    }
}