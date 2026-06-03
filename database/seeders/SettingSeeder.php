<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
  public function run(): void
  {
    $adminId = User::where('role', 'admin')->value('id');

    $settings = [
      [
        'key_name' => 'site_name',
        'value' => 'JTIFY',
        'data_type' => 'text',
        'description' => 'Nama utama website.',
      ],
      [
        'key_name' => 'site_tagline',
        'value' => 'Temukan peluang, tingkatkan kompetensi.',
        'data_type' => 'text',
        'description' => 'Slogan website yang muncul di beberapa area FE.',
      ],
      [
        'key_name' => 'logo_text',
        'value' => 'JTIFY',
        'data_type' => 'text',
        'description' => 'Teks logo utama.',
      ],
      [
        'key_name' => 'logo_mark',
        'value' => 'P',
        'data_type' => 'text',
        'description' => 'Mark kecil pada logo/footer seperti yang dipakai FE sekarang.',
      ],
      [
        'key_name' => 'footer_logo_text',
        'value' => 'Logo',
        'data_type' => 'text',
        'description' => 'Teks logo yang tampil di footer saat ini.',
      ],
      [
        'key_name' => 'footer_description',
        'value' => 'Cari peluang baru, upgrade skill, dan raih pengalaman terbaik bersama JTIFY.',
        'data_type' => 'textarea',
        'description' => 'Deskripsi singkat di footer.',
      ],
      [
        'key_name' => 'social_instagram_url',
        'value' => 'https://www.instagram.com/jtipolinema?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==',
        'data_type' => 'url',
        'description' => 'Link Instagram JTIFY.',
      ],
      [
        'key_name' => 'social_x_url',
        'value' => 'https://x.com/polinema_campus?s=20',
        'data_type' => 'url',
        'description' => 'Link X / Twitter JTIFY.',
      ],
      [
        'key_name' => 'social_youtube_url',
        'value' => 'https://www.youtube.com/@jtipolinema367',
        'data_type' => 'url',
        'description' => 'Link YouTube JTIFY.',
      ],
      [
        'key_name' => 'navbar_icon_url',
        'value' => 'https://img.icons8.com/ios-glyphs/30/FFFFFF/menu--v1.png',
        'data_type' => 'url',
        'description' => 'Icon menu di navbar jika ingin diganti ke aset dinamis.',
      ],
    ];

    foreach ($settings as $setting) {
      Setting::updateOrCreate(
        ['key_name' => $setting['key_name']],
        array_merge($setting, ['user_id' => $adminId])
      );
    }
  }
}
