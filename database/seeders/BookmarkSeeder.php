<?php

namespace Database\Seeders;

use App\Models\Bookmark;
use App\Models\Information;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'reguler')->pluck('id')->toArray();
        $informations = Information::query()->inRandomOrder()->take(30)->get();

        foreach ($informations as $index => $information) {
            if (empty($users)) {
                break;
            }

            Bookmark::updateOrCreate(
                [
                    'user_id' => $users[$index % count($users)],
                    'information_id' => $information->id,
                ],
                [
                    'reminder_enabled' => $index % 2 === 0,
                ]
            );
        }
    }
}