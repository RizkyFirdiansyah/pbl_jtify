<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CollaboratorController;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

// ============================================================
// HELPER: Pagination dengan filter kategori
// ============================================================

function _buildPaginatedItems(Request $request): array
{
    $category = $request->get('category', 'Semua Kategori');

    $allItems = collect([
        (object)['id' => 1, 'title' => 'Lomba UI/UX Design',      'category' => 'Lomba',    'date' => '2025-06-01'],
        (object)['id' => 2, 'title' => 'Beasiswa Unggulan 2025',   'category' => 'Beasiswa', 'date' => '2025-06-15'],
        (object)['id' => 3, 'title' => 'Seminar AI & Technology',  'category' => 'Seminar',  'date' => '2025-07-01'],
        (object)['id' => 4, 'title' => 'Lomba Karya Ilmiah',       'category' => 'Lomba',    'date' => '2025-07-10'],
        (object)['id' => 5, 'title' => 'Beasiswa LPDP 2025',       'category' => 'Beasiswa', 'date' => '2025-07-20'],
        (object)['id' => 6, 'title' => 'Workshop Web Development', 'category' => 'Seminar',  'date' => '2025-08-01'],
        (object)['id' => 7, 'title' => 'Lomba Poster Nasional',    'category' => 'Lomba',    'date' => '2025-08-05'],
        (object)['id' => 8, 'title' => 'Seminar Kewirausahaan',    'category' => 'Seminar',  'date' => '2025-08-10'],
    ]);

    $filtered = ($category !== 'Semua Kategori')
        ? $allItems->where('category', $category)->values()
        : $allItems;

    $perPage     = 6;
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $pageItems   = $filtered->slice(($currentPage - 1) * $perPage, $perPage)->values();

    $paginated = new LengthAwarePaginator(
        $pageItems,
        $filtered->count(),
        $perPage,
        $currentPage,
        ['path' => request()->url(), 'query' => request()->query()]
    );

    return [
        'paginated' => $paginated,
        'category'  => $category,
    ];
}

// ============================================================
// HALAMAN UTAMA
// ============================================================

Route::get('/', function () {
    $dbTips = \App\Models\Article::where('status', 'published')->latest()->take(4)->get();
    if ($dbTips->isNotEmpty()) {
        $tips = $dbTips->map(fn($item) => (object)[
            'judul' => $item->title,
            'deskripsi' => \Illuminate\Support\Str::limit(strip_tags($item->content), 100),
            'thumbnail' => $item->poster_path,
            'slug' => $item->slug
        ]);
    } else {
        $tips = collect([
            (object)['judul' => 'Cara Efektif Mempersiapkan Lomba Nasional',      'deskripsi' => 'Ikuti langkah-langkah teruji yang membantu ribuan mahasiswa meraih prestasi.',  'thumbnail' => null, 'slug' => 'tips-1'],
            (object)['judul' => 'Membangun Portofolio yang Menarik Rekruter',      'deskripsi' => 'Portofolio yang kuat dimulai jauh sebelum wisuda. Pelajari caranya sekarang.',   'thumbnail' => null, 'slug' => 'tips-2'],
            (object)['judul' => 'Manajemen Waktu untuk Mahasiswa Aktif Lomba',     'deskripsi' => 'Seimbangkan akademik, lomba, dan kehidupan sosial dengan sistem yang tepat.',    'thumbnail' => null, 'slug' => 'tips-3'],
            (object)['judul' => 'Tips Membangun Tim Lomba yang Solid',             'deskripsi' => 'Kemenangan lomba tim bukan soal siapa paling pintar, tapi siapa paling kompak.', 'thumbnail' => null, 'slug' => 'tips-4'],
        ]);
    }

    $feedbacks = \App\Models\Feedback::where('status', 'published')->with('user')->latest()->take(6)->get();

    return view('index', compact('tips', 'feedbacks'));
})->name('home');

// ============================================================
// AUTH (Penulisan Bersih & Fungsional Tanpa Duplikat)
// ============================================================

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
})->name('login.post');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ============================================================
// LOMBA, BEASISWA, SEMINAR
// ============================================================

// ============================================================
// LOMBA, BEASISWA, SEMINAR
// ============================================================

Route::get('/lomba',           function (Request $request) {
    $q = trim($request->get('q', ''));
    
    $query = \App\Models\Information::whereHas('category', fn($c) => $c->where('slug', 'lomba'))
        ->where('status', 'published');

    if (!empty($q)) {
        $query->where('title', 'like', '%' . $q . '%');
    }

    $dbItems = $query->latest()->get();

    if ($dbItems->isNotEmpty()) {
        $lombaData = $dbItems->map(fn($item) => [
            'id' => $item->id,
            'title' => $item->title,
            'deadline' => $item->deadline->format('d M Y'),
        ]);
    } else {
        $lombaData = collect([
            ['id' => 1, 'title' => 'UI/UX Design Competition 2025',          'deadline' => '10 Jun 2025'],
            ['id' => 2, 'title' => 'Hackathon Data Science Challenge',         'deadline' => '18 Jun 2025'],
            ['id' => 3, 'title' => 'National Coding Competition 2025',         'deadline' => '25 Jun 2025'],
            ['id' => 4, 'title' => 'Business Plan Competition Nasional',       'deadline' => '02 Jul 2025'],
            ['id' => 5, 'title' => 'Robotics Engineering Challenge 2025',      'deadline' => '09 Jul 2025'],
            ['id' => 6, 'title' => 'Essay & Karya Tulis Ilmiah Nasional',      'deadline' => '16 Jul 2025'],
            ['id' => 7, 'title' => 'Mobile App Innovation Contest 2025',       'deadline' => '23 Jul 2025'],
            ['id' => 8, 'title' => 'Video Kreatif & Sinematografi Mahasiswa',  'deadline' => '30 Jul 2025'],
        ]);

        if (!empty($q)) {
            $lombaData = $lombaData->filter(function($item) use ($q) {
                return stripos($item['title'], $q) !== false;
            });
        }
    }

    $page = (int) $request->input('page', 1);
    $perPage = 4;
    $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
        $lombaData->forPage($page, $perPage)->values(),
        $lombaData->count(),
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('lomba.index', ['lombaData' => $paginated, 'q' => $q]);
})->name('lomba');

Route::get('/detail-lomba/{id?}', function ($id = null) {
    $information = null;
    if ($id) {
        $information = \App\Models\Information::with('category')->find($id);
    }
    if (!$information) {
        $information = \App\Models\Information::whereHas('category', fn($q) => $q->where('slug', 'lomba'))->first();
    }

    $recommendations = \App\Models\Information::whereHas('category', fn($q) => $q->where('slug', 'lomba'))
        ->where('status', 'published')
        ->when($information, fn($q) => $q->where('id', '!=', $information->id))
        ->latest()
        ->take(6)
        ->get();

    return view('lomba.detail', compact('information', 'recommendations'));
})->name('lomba.detail');

Route::get('/beasiswa',         function (Request $request) {
    $q = trim($request->get('q', ''));
    
    $query = \App\Models\Information::whereHas('category', fn($c) => $c->where('slug', 'beasiswa'))
        ->where('status', 'published');

    if (!empty($q)) {
        $query->where('title', 'like', '%' . $q . '%');
    }

    $dbItems = $query->latest()->get();

    if ($dbItems->isNotEmpty()) {
        $beasiswaData = $dbItems->map(fn($item) => [
            'id' => $item->id,
            'title' => $item->title,
            'deadline' => $item->deadline->format('d M Y'),
        ]);
    } else {
        $beasiswaData = collect([
            ['id' => 1, 'title' => 'Beasiswa Prestasi Mahasiswa Unggulan',  'deadline' => '14 Jun 2025'],
            ['id' => 2, 'title' => 'Beasiswa Polinema Unggulan 2025',       'deadline' => '21 Jun 2025'],
            ['id' => 3, 'title' => 'Beasiswa Kemendikbud Ristek 2025',      'deadline' => '28 Jun 2025'],
            ['id' => 4, 'title' => 'Beasiswa BCA Finance Peduli Negeri',    'deadline' => '05 Jul 2025'],
            ['id' => 5, 'title' => 'Beasiswa Djarum Plus 2025',             'deadline' => '12 Jul 2025'],
            ['id' => 6, 'title' => 'Beasiswa LPDP Program S1 2025',         'deadline' => '19 Jul 2025'],
            ['id' => 7, 'title' => 'Beasiswa Bank Indonesia Mahasiswa',     'deadline' => '26 Jun 2025'],
            ['id' => 8, 'title' => 'Beasiswa XL Future Leaders 2025',       'deadline' => '02 Agu 2025'],
        ]);

        if (!empty($q)) {
            $beasiswaData = $beasiswaData->filter(function($item) use ($q) {
                return stripos($item['title'], $q) !== false;
            });
        }
    }

    $page = (int) $request->input('page', 1);
    $perPage = 4;
    $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
        $beasiswaData->forPage($page, $perPage)->values(),
        $beasiswaData->count(),
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('beasiswa.index', ['beasiswaData' => $paginated, 'q' => $q]);
})->name('beasiswa');

Route::get('/detail-beasiswa/{id?}', function ($id = null) {
    $information = null;
    if ($id) {
        $information = \App\Models\Information::with('category')->find($id);
    }
    if (!$information) {
        $information = \App\Models\Information::whereHas('category', fn($q) => $q->where('slug', 'beasiswa'))->first();
    }

    $recommendations = \App\Models\Information::whereHas('category', fn($q) => $q->where('slug', 'beasiswa'))
        ->where('status', 'published')
        ->when($information, fn($q) => $q->where('id', '!=', $information->id))
        ->latest()
        ->take(6)
        ->get();

    return view('beasiswa.detail', compact('information', 'recommendations'));
})->name('beasiswa.detail');

Route::get('/seminar',         function (Request $request) {
    $q = trim($request->get('q', ''));
    
    $query = \App\Models\Information::whereHas('category', fn($c) => $c->where('slug', 'seminar'))
        ->where('status', 'published');

    if (!empty($q)) {
        $query->where('title', 'like', '%' . $q . '%');
    }

    $dbItems = $query->latest()->get();

    if ($dbItems->isNotEmpty()) {
        $seminarData = $dbItems->map(fn($item) => [
            'id' => $item->id,
            'title' => $item->title,
            'deadline' => $item->deadline->format('d M Y'),
        ]);
    } else {
        $seminarData = collect([
            ['id' => 1, 'title' => 'Seminar Inovasi Teknologi Nasional',    'deadline' => '12 Jun 2025'],
            ['id' => 2, 'title' => 'Workshop Kecerdasan Buatan & ML',        'deadline' => '19 Jun 2025'],
            ['id' => 3, 'title' => 'Seminar Kewirausahaan Digital 2025',     'deadline' => '26 Jun 2025'],
            ['id' => 4, 'title' => 'Webinar Pengembangan Karier Mahasiswa',  'deadline' => '03 Jul 2025'],
            ['id' => 5, 'title' => 'Talk Show Startup & Inovasi Muda',       'deadline' => '10 Jul 2025'],
            ['id' => 6, 'title' => 'Seminar Nasional Pendidikan 4.0',        'deadline' => '17 Jul 2025'],
            ['id' => 7, 'title' => 'Workshop Desain Grafis Profesional',     'deadline' => '24 Jul 2025'],
            ['id' => 8, 'title' => 'Webinar Cloud Computing & DevOps',       'deadline' => '31 Jul 2025'],
        ]);

        if (!empty($q)) {
            $seminarData = $seminarData->filter(function($item) use ($q) {
                return stripos($item['title'], $q) !== false;
            });
        }
    }

    $page = (int) $request->input('page', 1);
    $perPage = 4;
    $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
        $seminarData->forPage($page, $perPage)->values(),
        $seminarData->count(),
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('seminar.index', ['seminarData' => $paginated, 'q' => $q]);
})->name('seminar');

Route::get('/detail-seminar/{id?}', function ($id = null) {
    $information = null;
    if ($id) {
        $information = \App\Models\Information::with('category')->find($id);
    }
    if (!$information) {
        $information = \App\Models\Information::whereHas('category', fn($q) => $q->where('slug', 'seminar'))->first();
    }

    $recommendations = \App\Models\Information::whereHas('category', fn($q) => $q->where('slug', 'seminar'))
        ->where('status', 'published')
        ->when($information, fn($q) => $q->where('id', '!=', $information->id))
        ->latest()
        ->take(6)
        ->get();

    return view('seminar.detail', compact('information', 'recommendations'));
})->name('seminar.detail');

// ============================================================
// BOOKMARK (Menggunakan Controller Terbaru dari HEAD)
// ============================================================

Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark');

// ============================================================
// PEMINATAN (Menggunakan Controller Terbaru dari HEAD)
// ============================================================

Route::get('/peminatan', [LikeController::class, 'index'])->name('peminatan');
Route::get('/diminati', [LikeController::class, 'index'])->name('diminati');

// ============================================================
// HALAMAN LAINNYA
// ============================================================

Route::get('/tips', function (Request $request) {
    $q = trim($request->get('q', ''));
    
    $query = \App\Models\Article::where('status', 'published');
    
    if (!empty($q)) {
        $query->where(function($builder) use ($q) {
            $builder->where('title', 'like', '%' . $q . '%')
                    ->orWhere('content', 'like', '%' . $q . '%');
        });
    }
    
    $dbTips = $query->latest()->get();
    
    if ($dbTips->isNotEmpty()) {
        $tipsData = $dbTips->map(fn($item) => [
            'slug'        => $item->slug,
            'title'       => $item->title,
            'description' => \Illuminate\Support\Str::limit(strip_tags($item->content), 120),
            'date'        => $item->approved_at ? $item->approved_at->format('d M Y') : $item->created_at->format('d M Y'),
        ]);
    } else {
        $tipsData = collect([
            [
                'slug'        => 'tips-1',
                'title'       => 'Cara Meningkatkan Peluang Lolos Seleksi Kompetisi',
                'description' => 'Pelajari strategi yang dapat membantu kamu mempersiapkan diri dengan lebih baik dan meningkatkan peluang keberhasilan dalam kompetisi.',
                'date'        => '12 Mei 2026',
            ],
            [
                'slug'        => 'tips-2',
                'title'       => 'Kesalahan Umum yang Sering Dilakukan Peserta Kompetisi',
                'description' => 'Hindari berbagai kesalahan yang sering terjadi saat mengikuti kompetisi agar performamu lebih maksimal.',
                'date'        => '10 Mei 2026',
            ],
            [
                'slug'        => 'tips-3',
                'title'       => 'Strategi Menyusun Tim yang Solid dan Efektif',
                'description' => 'Bangun kerja sama tim yang baik untuk mencapai hasil terbaik dalam berbagai kegiatan maupun perlombaan.',
                'date'        => '8 Mei 2026',
            ],
            [
                'slug'        => 'tips-4',
                'title'       => 'Tips Mengatur Waktu antara Kuliah dan Organisasi',
                'description' => 'Kelola waktu dengan lebih efektif agar aktivitas akademik dan non-akademik tetap berjalan seimbang.',
                'date'        => '5 Mei 2026',
            ],
            [
                'slug'        => 'tips-5',
                'title'       => 'Cara Membangun Portofolio yang Menarik',
                'description' => 'Pelajari langkah-langkah membuat portofolio yang profesional dan mampu menarik perhatian recruiter.',
                'date'        => '3 Mei 2026',
            ],
            [
                'slug'        => 'tips-6',
                'title'       => 'Meningkatkan Kemampuan Public Speaking Mahasiswa',
                'description' => 'Latihan sederhana yang dapat membantu meningkatkan rasa percaya diri saat berbicara di depan umum.',
                'date'        => '1 Mei 2026',
            ],
            [
                'slug'        => 'tips-7',
                'title'       => 'Tips Menulis CV yang ATS Friendly',
                'description' => 'Pelajari cara membuat CV yang mudah dibaca sistem ATS dan menarik perhatian recruiter.',
                'date'        => '28 Apr 2026',
            ],
            [
                'slug'        => 'tips-8',
                'title'       => 'Rahasia Produktif Saat Deadline Menumpuk',
                'description' => 'Teknik sederhana yang dapat membantu kamu tetap fokus dan menyelesaikan pekerjaan tepat waktu.',
                'date'        => '25 Apr 2026',
            ],
        ]);
    
        if (!empty($q)) {
            $tipsData = $tipsData->filter(function($item) use ($q) {
                return stripos($item['title'], $q) !== false || stripos($item['description'], $q) !== false;
            });
        }
    }
    
    $page = (int) $request->input('page', 1);
    $perPage = 4;
    $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
        $tipsData->forPage($page, $perPage)->values(),
        $tipsData->count(),
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );
    
    return view('tips.index', ['tipsData' => $paginated, 'q' => $q]);
})->name('tips');

Route::get('/tips/{slug}', function ($slug) {
    $article = \App\Models\Article::where('slug', $slug)->where('status', 'published')->first();
    
    if ($article) {
        $tip = [
            'slug'        => $article->slug,
            'title'       => $article->title,
            'category'    => 'Insight',
            'date'        => $article->approved_at ? $article->approved_at->format('d M Y') : $article->created_at->format('d M Y'),
            'read_time'   => '5 Menit Baca',
            'author'      => $article->user?->name ?? 'Admin',
            'author_role' => $article->user?->role ?? 'Penulis',
            'description' => \Illuminate\Support\Str::limit(strip_tags($article->content), 150),
            'key_takeaways' => [
                'Pahami materi/topik secara mendalam sebelum membagikan informasi.',
                'Validasi sumber referensi agar tulisan tetap kredibel.',
                'Fokus pada struktur penyampaian yang sistematis dan mudah dipahami.'
            ],
            'tags' => ['Tips', 'Insight', 'Artikel'],
            'content' => array_filter(explode("\n\n", $article->content))
        ];
        
        $dbRec = \App\Models\Article::where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();
            
        $recommendations = $dbRec->map(fn($item) => [
            'slug'        => $item->slug,
            'title'       => $item->title,
            'category'    => 'Insight',
            'date'        => $item->approved_at ? $item->approved_at->format('d M Y') : $item->created_at->format('d M Y'),
            'read_time'   => '5 Menit Baca',
            'author'      => $item->user?->name ?? 'Admin',
            'author_role' => $item->user?->role ?? 'Penulis',
            'description' => \Illuminate\Support\Str::limit(strip_tags($item->content), 150),
        ])->toArray();
    } else {
        $tipsDatabase = [
            'tips-1' => [
                'slug'        => 'tips-1',
                'title'       => 'Cara Meningkatkan Peluang Lolos Seleksi Kompetisi',
                'category'    => 'Kompetisi',
                'date'        => '12 Mei 2026',
                'read_time'   => '5 Menit Baca',
                'author'      => 'Muhammad Rian',
                'author_role' => 'Juara PIMNAS & Mentor Prestasi',
                'description' => 'Pelajari strategi teruji untuk menyempurnakan proposal, desain, dan persiapan teknis kompetisi Anda.',
                'key_takeaways' => [
                    'Pahami panduan penilaian juri secara mendalam sebelum mulai membuat karya.',
                    'Validasi ide melalui feedback berkala dari mentor atau dosen pembimbing.',
                    'Fokus pada visualisasi solusi yang problem-solving dan inovatif.'
                ],
                'tags' => ['Lomba', 'Prestasi', 'Strategi', 'Kuliah'],
                'content' => [
                    'Mengikuti kompetisi tingkat nasional maupun internasional merupakan salah satu langkah paling efektif bagi mahasiswa untuk mengasah keterampilan praktis sekaligus memperluas jaringan profesional. Namun, banyak tim berbakat gagal lolos seleksi awal bukan karena ide mereka kurang bagus, melainkan karena kegagalan dalam memenuhi kriteria mendasar yang dinilai oleh juri.',
                    'Langkah pertama dan yang paling krusial adalah memahami buku panduan (guidebook) kompetisi secara detail. Juri memiliki lembar penilaian dengan bobot skor tertentu untuk setiap aspek. Jika proposal Anda tidak menjawab kriteria penilaian tersebut secara eksplisit, skor Anda akan jatuh meskipun ide solusinya sangat revolusioner. Selaraskan terminologi dalam proposal Anda dengan kata kunci yang digunakan dalam kriteria penilaian juri.',
                    'Selanjutnya, lakukan riset pasar atau validasi masalah secara nyata. Ide yang hebat selalu dimulai dari masalah yang nyata (real problem). Lakukan survei singkat, wawancara pengguna, atau gunakan data sekunder yang kredibel untuk membuktikan bahwa masalah yang Anda angkat memang patut dicarikan solusinya. Sajikan data ini dalam bentuk grafik atau infografis yang mudah dipahami pada bagian pendahuluan proposal Anda.',
                    'Terakhir, jangan ragu untuk melakukan iterasi karya berdasarkan feedback. Temui dosen pembimbing atau alumni yang pernah memenangkan kompetisi serupa untuk meninjau draf proposal Anda. Kritik yang konstruktif dari sudut pandang eksternal sering kali berhasil menemukan celah logis atau kekurangan presentasi yang tidak disadari oleh tim Anda sendiri.'
                ]
            ],
            'tips-2' => [
                'slug'        => 'tips-2',
                'title'       => 'Kesalahan Umum yang Sering Dilakukan Peserta Kompetisi',
                'category'    => 'Kompetisi',
                'date'        => '10 Mei 2026',
                'read_time'   => '4 Menit Baca',
                'author'      => 'Siti Aisyah',
                'author_role' => 'Koordinator Kompetisi JTIFY',
                'description' => 'Banyak kegagalan disebabkan oleh kelalaian kecil. Kenali dan hindari kesalahan ini demi performa terbaik Anda.',
                'key_takeaways' => [
                    'Mengirimkan berkas terlalu dekat dengan batas waktu tenggat pendaftaran (deadline).',
                    'Komunikasi internal tim yang kurang efektif selama proses pengerjaan.',
                    'Mengabaikan format penulisan dan batasan jumlah kata.'
                ],
                'tags' => ['Lomba', 'Evaluasi', 'Tips & Insight'],
                'content' => [
                    'Setiap tahun, ratusan karya hebat tereliminasi pada tahap seleksi administratif bahkan sebelum dinilai secara substantif oleh juri. Kesalahan-kesalahan ini sebagian besar bersifat teknis and administratif, yang sebenarnya sangat mudah untuk dicegah jika tim bekerja dengan lebih terorganisir.',
                    'Salah satu kesalahan paling sering adalah "Prokrastinasi Deadline". Mengunggah berkas di menit-menit terakhir sebelum sistem ditutup sangat berisiko tinggi terhadap masalah server down, koneksi internet tidak stabil, atau dokumen yang terlewat. Biasakan untuk menetapkan deadline internal tim setidaknya 24 hingga 48 jam sebelum deadline resmi dari panitia.',
                    'Selain itu, ketidakpatuhan terhadap format berkas yang ditentukan (seperti ukuran font, margin, format penulisan nama file, atau batas halaman) adalah jalan pintas menuju diskualifikasi instant. Juri menggunakan aturan administratif untuk memfilter kiriman yang sangat banyak secara cepat. Pastikan satu orang di tim Anda bertindak sebagai Quality Controller khusus untuk memverifikasi kesesuaian format sebelum berkas dikirim.'
                ]
            ],
            'tips-3' => [
                'slug'        => 'tips-3',
                'title'       => 'Strategi Menyusun Tim yang Solid dan Efektif',
                'category'    => 'Kolaborasi',
                'date'        => '8 Mei 2026',
                'read_time'   => '5 Menit Baca',
                'author'      => 'Dwi Cahyo',
                'author_role' => 'HR Specialist & Aktivis Mahasiswa',
                'description' => 'Membangun sinergi tim bukan hanya tentang menyatukan orang-orang pintar, tapi tentang penyelarasan peran.',
                'key_takeaways' => [
                    'Bentuk tim dengan keahlian yang saling melengkapi (multidisiplin), bukan keahlian yang sama.',
                    'Tetapkan peran dan tanggung jawab yang jelas sejak hari pertama.',
                    'Buat kesepakatan komitmen waktu dan gaya komunikasi tim.'
                ],
                'tags' => ['Tim', 'Manajemen', 'Kolaborasi'],
                'content' => [
                    'Komposisi tim adalah penentu utama keberhasilan suatu proyek atau lomba. Tim yang ideal tidak terdiri dari orang-orang dengan keahlian yang identik, melainkan kombinasi individu yang memiliki kompetensi saling melengkapi (cross-functional team).',
                    'Dalam dunia kompetisi mahasiswa, sering dikenal konsep Hustler (pemimpin & presenter), Hipster (desainer UI/UX & estetika), dan Hacker (programmer & pengembang teknis). Ketika ketiga peran ini terisi oleh orang yang tepat, proses pengerjaan karya akan berjalan dengan efisien tanpa adanya tumpang tindih tanggung jawab.',
                    'Selain pembagian peran teknis, chemistry dan kenyamanan komunikasi adalah pondasi utama. Buatlah sesi diskusi non-formal di awal pembentukan tim untuk menyamakan visi, target pencapaian, serta kesepakatan konsekuensi jika ada anggota yang tidak memenuhi komitmen kerja. Transparansi sejak dini akan meminimalkan konflik internal di tengah jalan.'
                ]
            ],
            'tips-4' => [
                'slug'        => 'tips-4',
                'title'       => 'Tips Mengatur Waktu antara Kuliah dan Organisasi',
                'category'    => 'Akademik',
                'date'        => '5 Mei 2026',
                'read_time'   => '4 Menit Baca',
                'author'      => 'Rian Hidayat',
                'author_role' => 'Mantan Ketua BEM & Lulusan Terbaik',
                'description' => 'Kelola prioritas Anda dengan sistematis agar kehidupan akademik dan organisasi berjalan seimbang.',
                'key_takeaways' => [
                    'Gunakan teknik Time Blocking untuk mengalokasikan waktu belajar dan berorganisasi.',
                    'Berani berkata "tidak" pada tugas tambahan jika kapasitas waktu Anda sudah penuh.',
                    'Selalu catat tenggat tugas kuliah dan agenda rapat organisasi dalam kalender digital.'
                ],
                'tags' => ['Kuliah', 'Waktu', 'Organisasi', 'Produktif'],
                'content' => [
                    'Bagi mahasiswa aktif, menyeimbangkan tugas akademis dengan tanggung jawab di organisasi kemahasiswaan sering kali menjadi tantangan tersendiri yang memicu stres. Kuncinya tidak terletak pada berapa banyak waktu yang Anda miliki, melainkan bagaimana Anda mengelola prioritas tersebut.',
                    'Mulailah menggunakan tools produktivitas seperti Google Calendar atau Notion untuk memetakan waktu harian Anda. Alokasikan waktu khusus (Time Block) untuk mengerjakan tugas kuliah secara fokus tanpa adanya distraksi notifikasi chat organisasi. Begitupun sebaliknya, saat waktu rapat organisasi, berikan kontribusi penuh agar diskusi berjalan efektif.',
                    'Ingatlah tujuan utama Anda di kampus. Organisasi adalah wadah belajar soft skills yang luar biasa, namun prestasi akademik tetap memerlukan perhatian yang cukup. Jika Anda merasa mulai kewalahan, komunikasikan dengan rekan organisasi Anda untuk mendelegasikan tugas atau mengambil jeda singkat guna mempersiapkan ujian.'
                ]
            ],
            'tips-5' => [
                'slug'        => 'tips-5',
                'title'       => 'Cara Membangun Portofolio yang Menarik',
                'category'    => 'Karir',
                'date'        => '3 Mei 2026',
                'read_time'   => '6 Menit Baca',
                'author'      => 'Aulia Putri',
                'author_role' => 'Senior UI/UX Designer @ Tech Company',
                'description' => 'Portofolio adalah cerminan dari kemampuan Anda secara nyata. Pelajari cara mengemas studi kasus Anda.',
                'key_takeaways' => [
                    'Tampilkan proses pemecahan masalah (case study), jangan hanya hasil akhir karya.',
                    'Kurasi karya terbaik Anda (3-4 proyek berkualitas lebih baik dari 10 proyek biasa saja).',
                    'Gunakan platform yang mudah diakses recruiter (seperti Behance, GitHub, atau web pribadi).'
                ],
                'tags' => ['Karir', 'Portofolio', 'Desain', 'Tips'],
                'content' => [
                    'Di era rekrutmen modern, portofolio memiliki bobot nilai yang sangat besar, terutama di industri kreatif dan teknologi. Recruiter tidak hanya ingin melihat sertifikat, melainkan bukti nyata dari keahlian yang Anda klaim di CV.',
                    'Kesalahan umum pembuat portofolio adalah hanya memajang hasil akhir berupa gambar mockup atau potongan kode tanpa penjelasan. Portofolio yang baik harus menceritakan proses bisnis dan desain (storytelling). Jelaskan latar belakang masalah, peran Anda dalam tim, langkah riset yang diambil, keputusan desain, hingga hasil evaluasi proyek tersebut.',
                    'Pastikan portofolio Anda mudah dibaca dan memiliki navigasi yang intuitif. Tulis deskripsi dengan ringkas, gunakan poin-poin penting, dan beri sorotan pada dampak positif yang dihasilkan oleh proyek Anda (misalnya: meningkatkan konversi pendaftaran sebesar 20% atau mempercepat waktu loading halaman).'
                ]
            ],
            'tips-6' => [
                'slug'        => 'tips-6',
                'title'       => 'Meningkatkan Kemampuan Public Speaking Mahasiswa',
                'category'    => 'Pengembangan Diri',
                'date'        => '1 Mei 2026',
                'read_time'   => '4 Menit Baca',
                'author'      => 'Budi Santoso',
                'author_role' => 'Public Speaking Coach & Trainer',
                'description' => 'Kuasai teknik dasar berbicara di depan umum untuk menunjang presentasi kuliah dan presentasi lomba.',
                'key_takeaways' => [
                    'Latih intonasi suara, tempo bicara, dan bahasa tubuh (body language) Anda.',
                    'Gunakan visual slide presentasi sebagai pemandu konsep, bukan teks bacaan penuh.',
                    'Lakukan simulasi atau latihan di depan cermin sebelum hari presentasi dimulai.'
                ],
                'tags' => ['Public Speaking', 'Presentasi', 'Soft Skills'],
                'content' => [
                    'Public speaking bukanlah bakat bawaan lahir, melainkan keterampilan yang dilatih secara konsisten. Bagi mahasiswa, kemampuan ini sangat penting untuk menyukseskan presentasi tugas kuliah, mempresentasikan ide bisnis di depan juri lomba, hingga saat memimpin rapat.',
                    'Kunci dari ketenangan saat berbicara di depan umum adalah persiapan materi yang matang. Pahami audiens Anda terlebih dahulu agar Anda dapat menyesuaikan gaya bahasa dan contoh kasus yang relevan. Saat presentasi, hindari membaca teks pada slide secara mentah-mentah; gunakan poin-poin ringkas dan ceritakan detailnya secara interaktif.',
                    'Selain itu, perhatikan bahasa tubuh Anda. Berdirilah dengan tegak, pertahankan kontak mata dengan audiens secara bergantian, dan gunakan gerakan tangan yang natural untuk menegaskan poin-poin penting. Latihan pernapasan dalam (diaphragmatic breathing) sebelum naik panggung juga sangat membantu meredakan demam panggung.'
                ]
            ],
            'tips-7' => [
                'slug'        => 'tips-7',
                'title'       => 'Tips Menulis CV yang ATS Friendly',
                'category'    => 'Karir',
                'date'        => '28 Apr 2026',
                'read_time'   => '5 Menit Baca',
                'author'      => 'Clarissa Amanda',
                'author_role' => 'Recruiter & Career Consultant',
                'description' => 'Pastikan CV Anda lolos seleksi otomatis Applicant Tracking System dengan optimasi tata letak dan kata kunci.',
                'key_takeaways' => [
                    'Gunakan format file PDF/Word dengan tata letak satu kolom yang bersih.',
                    'Hindari penggunaan grafik, tabel rumit, ikon, dan progress bar keahlian.',
                    'Masukkan kata kunci (keywords) yang relevan dengan deskripsi lowongan pekerjaan.'
                ],
                'tags' => ['Karir', 'CV', 'ATS', 'Kerja'],
                'content' => [
                    'Banyak perusahaan besar kini menggunakan sistem perangkat lunak Applicant Tracking System (ATS) untuk menyaring ribuan CV pelamar secara otomatis berdasarkan kecocokan kata kunci. Jika CV Anda tidak didesain agar kompatibel dengan sistem ini, CV Anda tidak akan pernah sampai ke meja HRD.',
                    'Untuk membuat CV ATS Friendly, pilihlah font standar seperti Arial, Calibri, atau Times New Roman dengan ukuran teks 10-12 pt. Desainlah CV secara minimalis tanpa hiasan grafik berwarna-warni atau grafik persentase kemampuan (skill bar) karena sistem ATS tidak dapat membaca format gambar dengan baik.',
                    'Sebutkan pengalaman kerja Anda dengan formula XYZ (mencapai hasil [X], diukur dengan [Y], dengan melakukan tindakan [Z]). Masukkan istilah teknis yang sesuai dengan persyaratan posisi yang Anda lamar agar tingkat kecocokan skor CV Anda di sistem ATS dinilai tinggi.'
                ]
            ],
            'tips-8' => [
                'slug'        => 'tips-8',
                'title'       => 'Rahasia Produktif Saat Deadline Menumpuk',
                'category'    => 'Produktif',
                'date'        => '25 Apr 2026',
                'read_time'   => '4 Menit Baca',
                'author'      => 'Rendy Pratama',
                'author_role' => 'Content Creator & Productivity Coach',
                'description' => 'Gunakan metode Pomodoro dan prioritas Eisenhower Matrix untuk mengatasi rasa cemas saat tugas menumpuk.',
                'key_takeaways' => [
                    'Kelompokkan tugas berdasarkan urgensi dan kepentingan (Eisenhower Matrix).',
                    'Fokus pada satu tugas dalam satu waktu (monotasking), hindari multitasking.',
                    'Terapkan sesi fokus Pomodoro (25 menit kerja, 5 menit istirahat).'
                ],
                'tags' => ['Produktif', 'Waktu', 'Fokus', 'Stress Management'],
                'content' => [
                    'Ketika dihadapkan pada tumpukan tugas kuliah, laporan praktikum, dan urusan organisasi yang tenggat waktunya bersamaan, kita sering kali mengalami burnout atau kelumpuhan produktivitas (analysis paralysis) karena bingung harus memulai dari mana.',
                    'Langkah awal mengatasi kecemasan ini adalah dengan menuliskan daftar semua tugas tersebut (brain dump), lalu klasifikasikan menggunakan Matriks Eisenhower. Mulailah mengerjakan tugas yang masuk dalam kategori "Penting & Mendesak" terlebih dahulu. Delegasikan atau jadwalkan tugas lain yang kurang mendesak di waktu berikutnya.',
                    'Selama bekerja, matikan seluruh distraksi eksternal. Studi membuktikan bahwa multitasking menurunkan efisiensi kerja hingga 40%. Gunakan timer Pomodoro untuk melatih otak Anda fokus secara penuh selama 25 menit, diikuti dengan istirahat sejenak untuk memulihkan energi mental sebelum melanjutkan sesi berikutnya.'
                ]
            ],
        ];
        
        if (!array_key_exists($slug, $tipsDatabase)) {
            return redirect()->route('tips');
        }
    
        $tip = $tipsDatabase[$slug];
        
        $recommendations = collect($tipsDatabase)
            ->forget($slug)
            ->shuffle()
            ->take(3)
            ->values()
            ->toArray();
    }

    return view('tips.detail', compact('tip', 'recommendations'));
})->name('tips.detail');

Route::get('/tentang',  fn () => view('about.tentang'))->name('tentang');
Route::get('/profile',  fn () => view('feature.profile'))->name('profile')->middleware('auth');
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// COLLABORATOR REGISTER
Route::get('/collaborator/register', [CollaboratorController::class, 'showRegistrationForm'])->name('collaborator.register');
Route::post('/collaborator/register', [CollaboratorController::class, 'storeRegistration'])->name('collaborator.register.store')->middleware('auth');