<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageContent;
use App\Models\User;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
  public function run(): void
  {
    $adminId = User::where('role', 'admin')->value('id');

    $pages = Page::query()->pluck('id', 'slug');

    $contents = [
      'home' => [
        ['key' => 'hero_brand', 'type' => 'text', 'value' => 'JTIFY', 'order' => 1],
        ['key' => 'hero_title_line_1', 'type' => 'text', 'value' => 'Temukan Peluang,', 'order' => 2],
        ['key' => 'hero_highlight_1', 'type' => 'text', 'value' => 'Peluang,', 'order' => 3],
        ['key' => 'hero_title_line_2', 'type' => 'text', 'value' => 'Tingkatkan Kompetensi', 'order' => 4],
        ['key' => 'hero_highlight_2', 'type' => 'text', 'value' => 'Kompetensi', 'order' => 5],
        ['key' => 'search_placeholder', 'type' => 'text', 'value' => 'Cari informasi', 'order' => 6],
        ['key' => 'category_default', 'type' => 'text', 'value' => 'Kategori', 'order' => 7],
        ['key' => 'cta_lihat_semua', 'type' => 'text', 'value' => 'Lihat semua', 'order' => 8],
        ['key' => 'section_tabs', 'type' => 'json', 'value' => json_encode(['Popular', 'Lomba', 'Seminar', 'Beasiswa']), 'order' => 9],
        ['key' => 'hero_card_titles', 'type' => 'json', 'value' => json_encode([
          'UI/UX Design Competition 2025',
          'Seminar Inovasi Teknologi Nasional',
          'Beasiswa Prestasi Mahasiswa Berprestasi',
          'Hackathon Data Science Challenge',
          'Workshop Kecerdasan Buatan & ML',
          'Beasiswa Polinema Unggulan 2025',
          'National Coding Competition 2025',
          'Seminar Kewirausahaan Digital',
        ]), 'order' => 10],
        ['key' => 'hero_card_deadlines', 'type' => 'json', 'value' => json_encode([
          '10 Jun 2025', '15 Jun 2025', '20 Jun 2025', '25 Jun 2025',
          '30 Jun 2025', '05 Jul 2025', '10 Jul 2025', '15 Jul 2025',
        ]), 'order' => 11],
      ],
      'tentang-kami' => [
        ['key' => 'intro_label', 'type' => 'text', 'value' => 'Siapa Kami', 'order' => 1],
        ['key' => 'intro_title', 'type' => 'text', 'value' => 'Kenalan dengan JTIFY', 'order' => 2],
        ['key' => 'intro_description', 'type' => 'textarea', 'value' => 'JTIFY adalah platform informasi mahasiswa Jurusan Teknologi Informasi Politeknik Negeri Malang yang hadir untuk mempermudah akses terhadap berbagai peluang akademik dan pengembangan diri semuanya dalam satu tempat.', 'order' => 3],
        ['key' => 'background_label', 'type' => 'text', 'value' => 'Latar Belakang', 'order' => 4],
        ['key' => 'background_title', 'type' => 'text', 'value' => 'Kenapa JTIFY Dibuat?', 'order' => 5],
        ['key' => 'background_description', 'type' => 'textarea', 'value' => 'Informasi lomba, beasiswa, dan seminar selama ini tersebar di berbagai platform Instagram, grup WhatsApp, website kampus. Mahasiswa sering ketinggalan atau kesulitan menemukannya tepat waktu.', 'order' => 6],
        ['key' => 'solution_label', 'type' => 'text', 'value' => 'Solusi', 'order' => 7],
        ['key' => 'solution_title', 'type' => 'text', 'value' => 'Satu Pintu, Semua Peluang', 'order' => 8],
        ['key' => 'solution_description', 'type' => 'textarea', 'value' => 'JTIFY hadir sebagai satu platform terpusat untuk semua informasi itu. Kami percaya setiap mahasiswa berhak mendapat akses yang sama terhadap peluang terbaik, tanpa harus repot mencarinya satu per satu.', 'order' => 9],
        ['key' => 'vision_label', 'type' => 'text', 'value' => 'Visi', 'order' => 10],
        ['key' => 'vision_title', 'type' => 'text', 'value' => 'Menjadi Ruang Tumbuh Mahasiswa', 'order' => 11],
        ['key' => 'vision_description', 'type' => 'textarea', 'value' => 'Menjadi platform informasi mahasiswa JTI yang terlengkap, terpercaya, dan mudah diakses, mendorong setiap mahasiswa untuk terus berkembang dan meraih potensi terbaiknya.', 'order' => 12],
        ['key' => 'mission_label', 'type' => 'text', 'value' => 'Misi', 'order' => 13],
        ['key' => 'mission_title', 'type' => 'text', 'value' => 'Apa yang Kami Lakukan', 'order' => 14],
        ['key' => 'mission_description', 'type' => 'json', 'value' => json_encode([
          'Mengumpulkan informasi peluang dari berbagai sumber terpercaya',
          'Menyajikan informasi yang akurat, lengkap, dan tepat waktu',
          'Membangun komunitas mahasiswa yang aktif dan berprestasi',
        ]), 'order' => 15],
        ['key' => 'features_label', 'type' => 'text', 'value' => 'Apa Saja di JTIFY', 'order' => 16],
        ['key' => 'features_title', 'type' => 'text', 'value' => 'Fitur yang Tersedia', 'order' => 17],
        ['key' => 'feature_competition_title', 'type' => 'text', 'value' => 'Lomba', 'order' => 18],
        ['key' => 'feature_competition_description', 'type' => 'textarea', 'value' => 'Kompetisi nasional & internasional desain, teknologi, sains, bisnis, dan banyak lagi.', 'order' => 19],
        ['key' => 'feature_seminar_title', 'type' => 'text', 'value' => 'Seminar', 'order' => 20],
        ['key' => 'feature_seminar_description', 'type' => 'textarea', 'value' => 'Jadwal seminar, webinar, dan workshop untuk mengasah skill dan memperluas wawasan.', 'order' => 21],
        ['key' => 'feature_scholarship_title', 'type' => 'text', 'value' => 'Beasiswa', 'order' => 22],
        ['key' => 'feature_scholarship_description', 'type' => 'textarea', 'value' => 'Info beasiswa dari berbagai lembaga, lengkap dengan syarat, deadline, dan cara daftar.', 'order' => 23],
      ],
      'footer' => [
        ['key' => 'footer_brand_label', 'type' => 'text', 'value' => 'Logo', 'order' => 1],
        ['key' => 'footer_description', 'type' => 'textarea', 'value' => 'Cari peluang baru, upgrade skill, dan raih pengalaman terbaik bersama JTIFY.', 'order' => 2],
        ['key' => 'footer_social_label', 'type' => 'text', 'value' => 'Follow Us:', 'order' => 3],
        ['key' => 'footer_home_title', 'type' => 'text', 'value' => 'Beranda', 'order' => 4],
        ['key' => 'footer_feature_title', 'type' => 'text', 'value' => 'Feature', 'order' => 5],
        ['key' => 'footer_lomba_label', 'type' => 'text', 'value' => 'Informasi Lomba', 'order' => 6],
        ['key' => 'footer_seminar_label', 'type' => 'text', 'value' => 'Informasi Seminar', 'order' => 7],
        ['key' => 'footer_beasiswa_label', 'type' => 'text', 'value' => 'Informasi Beasiswa', 'order' => 8],
        ['key' => 'footer_bookmark_label', 'type' => 'text', 'value' => 'Bookmark', 'order' => 9],
        ['key' => 'footer_diminati_label', 'type' => 'text', 'value' => 'Diminati', 'order' => 10],
        ['key' => 'footer_feedback_label', 'type' => 'text', 'value' => 'Feedback', 'order' => 11],
        ['key' => 'footer_instagram_url', 'type' => 'url', 'value' => 'https://www.instagram.com/jtipolinema?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==', 'order' => 12],
        ['key' => 'footer_x_url', 'type' => 'url', 'value' => 'https://x.com/polinema_campus?s=20', 'order' => 13],
        ['key' => 'footer_youtube_url', 'type' => 'url', 'value' => 'https://www.youtube.com/@jtipolinema367', 'order' => 14],
        ['key' => 'footer_logo_mark', 'type' => 'text', 'value' => 'P', 'order' => 15],
      ],
      'navbar' => [
        ['key' => 'brand_name', 'type' => 'text', 'value' => 'JTIFY', 'order' => 1],
        ['key' => 'menu_home', 'type' => 'text', 'value' => 'Beranda', 'order' => 2],
        ['key' => 'menu_tips', 'type' => 'text', 'value' => 'Tips', 'order' => 3],
        ['key' => 'menu_tentang', 'type' => 'text', 'value' => 'Tentang Kami', 'order' => 4],
        ['key' => 'login_label', 'type' => 'text', 'value' => 'Login', 'order' => 5],
        ['key' => 'profile_setting_label', 'type' => 'text', 'value' => 'Setting Profile', 'order' => 6],
        ['key' => 'profile_bookmark_label', 'type' => 'text', 'value' => 'Bookmark', 'order' => 7],
        ['key' => 'profile_diminati_label', 'type' => 'text', 'value' => 'Diminati', 'order' => 8],
        ['key' => 'logout_label', 'type' => 'text', 'value' => 'Log Out', 'order' => 9],
      ],
    ];

    foreach ($contents as $slug => $items) {
      $pageId = $pages->get($slug);

      if (! $pageId) {
        continue;
      }

      foreach ($items as $item) {
        PageContent::updateOrCreate(
          [
            'page_id' => $pageId,
            'content_key' => $item['key'],
          ],
          [
            'user_id' => $adminId,
            'content_type' => $item['type'],
            'content_value' => $item['value'],
            'sort_order' => $item['order'],
            'is_active' => true,
          ]
        );
      }
    }
  }
}
