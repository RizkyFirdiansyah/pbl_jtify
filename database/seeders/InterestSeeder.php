<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interest;
use App\Models\Information;
use App\Models\User;

class InterestSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();
        $informations = Information::all();

        foreach ($informations as $information) {

            // jumlah interest random
            $totalInterest = rand(5, 20);

            $randomUsers = collect($users)
                ->shuffle()
                ->take($totalInterest);

            foreach ($randomUsers as $userId) {

                Interest::create([
                    'user_id' => $userId,
                    'information_id' => $information->id,
                    'status' => 'active',
                ]);
            }
        }
    }
}