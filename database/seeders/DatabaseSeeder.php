<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\ArticleSeeder;
use Database\Seeders\BookmarkSeeder;
use Database\Seeders\CollaboratorSeeder;
use Database\Seeders\FeedbackSeeder;
use Database\Seeders\LikeSeeder;
use Database\Seeders\NotificationSeeder;
use Database\Seeders\PageContentSeeder;
use Database\Seeders\PageSeeder;
use Database\Seeders\SettingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PageSeeder::class,
            SettingSeeder::class,
            PageContentSeeder::class,
            // CollaboratorSeeder::class,
            // InformationSeeder::class,
            // ArticleSeeder::class,
            // BookmarkSeeder::class,
            // LikeSeeder::class,
            // InterestSeeder::class,
            FeedbackSeeder::class,
            // NotificationSeeder::class,
        ]);
    }
}
