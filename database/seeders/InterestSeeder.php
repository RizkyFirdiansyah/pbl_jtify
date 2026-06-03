<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interest;
use App\Models\Information;
use App\Models\User;
use Illuminate\Support\Carbon;

class InterestSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'reguler')->pluck('id')->toArray();
        $informations = Information::query()->get();

        foreach ($informations as $index => $information) {
            if (empty($users)) {
                break;
            }

            $totalInterest = min(count($users), 5 + ($index % 11));

            $randomUsers = collect($users)
                ->shuffle()
                ->take($totalInterest);

            foreach ($randomUsers as $offset => $userId) {
                $isActive = ($offset + $index) % 5 !== 0;

                Interest::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'information_id' => $information->id,
                    ],
                    [
                        'status' => $isActive ? 'active' : 'cancelled',
                        'consented_at' => $isActive ? Carbon::now()->subDays(rand(1, 40)) : null,
                    ]
                );
            }
        }
    }
}