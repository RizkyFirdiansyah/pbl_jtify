<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Workshop', 'slug' => 'workshop'],
            ['name' => 'Lomba', 'slug' => 'lomba'],
            ['name' => 'Beasiswa', 'slug' => 'beasiswa'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
