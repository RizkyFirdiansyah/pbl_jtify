<?php

namespace Database\Seeders;

use App\Models\Information;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'reguler')->pluck('id')->toArray();
        $informations = Information::query()->inRandomOrder()->take(45)->get();

        foreach ($informations as $index => $information) {
            if (empty($users)) {
                break;
            }

            Like::updateOrCreate(
                [
                    'user_id' => $users[$index % count($users)],
                    'information_id' => $information->id,
                ],
                [
                    'status' => $index % 4 === 0 ? 'cancelled' : 'active',
                ]
            );
        }
    }
}