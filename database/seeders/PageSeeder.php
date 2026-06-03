<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
  public function run(): void
  {
    $adminId = User::where('role', 'admin')->value('id');

    $pages = [
      [
        'name' => 'Beranda',
        'slug' => 'home',
        'description' => 'Konten halaman beranda JTIFY.',
        'is_active' => true,
      ],
      [
        'name' => 'Tentang Kami',
        'slug' => 'tentang-kami',
        'description' => 'Konten halaman tentang JTIFY.',
        'is_active' => true,
      ],
      [
        'name' => 'Footer',
        'slug' => 'footer',
        'description' => 'Konten footer global website.',
        'is_active' => true,
      ],
      [
        'name' => 'Navbar',
        'slug' => 'navbar',
        'description' => 'Label navigasi dan identitas header.',
        'is_active' => true,
      ],
    ];

    foreach ($pages as $page) {
      Page::updateOrCreate(
        ['slug' => $page['slug']],
        array_merge($page, ['user_id' => $adminId])
      );
    }
  }
}
