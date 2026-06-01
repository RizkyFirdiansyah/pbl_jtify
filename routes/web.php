<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LikeController;
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
    $tips = collect([
        (object)['judul' => 'Cara Efektif Mempersiapkan Lomba Nasional',      'deskripsi' => 'Ikuti langkah-langkah teruji yang membantu ribuan mahasiswa meraih prestasi.',  'thumbnail' => null, 'slug' => 'tips-1'],
        (object)['judul' => 'Membangun Portofolio yang Menarik Rekruter',      'deskripsi' => 'Portofolio yang kuat dimulai jauh sebelum wisuda. Pelajari caranya sekarang.',   'thumbnail' => null, 'slug' => 'tips-2'],
        (object)['judul' => 'Manajemen Waktu untuk Mahasiswa Aktif Lomba',     'deskripsi' => 'Seimbangkan akademik, lomba, dan kehidupan sosial dengan sistem yang tepat.',    'thumbnail' => null, 'slug' => 'tips-3'],
        (object)['judul' => 'Tips Membangun Tim Lomba yang Solid',             'deskripsi' => 'Kemenangan lomba tim bukan soal siapa paling pintar, tapi siapa paling kompak.', 'thumbnail' => null, 'slug' => 'tips-4'],
    ]);
    return view('index', compact('tips'));
})->name('home');

// ============================================================
// AUTH (Penulisan Bersih & Fungsional Tanpa Duplikat)
// ============================================================

Route::get('/login', fn () => view('login'))->name('login');
Route::get('/register', fn () => view('register'))->name('register');

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

Route::get('/lomba',           fn () => view('lomba.index'))->name('lomba');
Route::get('/detail-lomba',    fn () => view('lomba.detail'))->name('lomba.detail');

Route::get('/beasiswa',         fn () => view('beasiswa.index'))->name('beasiswa');
Route::get('/detail-beasiswa',  fn () => view('beasiswa.detail'))->name('beasiswa.detail');

Route::get('/seminar',         fn () => view('seminar.index'))->name('seminar');
Route::get('/detail-seminar',  fn () => view('seminar.detail'))->name('seminar.detail');

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

Route::get('/tips', function () {
    $tips = collect([
        (object)['judul' => 'Cara Efektif Mempersiapkan Lomba Nasional',      'deskripsi' => 'Ikuti langkah-langkah teruji yang membantu ribuan mahasiswa meraih prestasi.',  'thumbnail' => null, 'slug' => 'tips-1'],
        (object)['judul' => 'Membangun Portofolio yang Menarik Rekruter',      'deskripsi' => 'Portofolio yang kuat dimulai jauh sebelum wisuda. Pelajari caranya sekarang.',   'thumbnail' => null, 'slug' => 'tips-2'],
        (object)['judul' => 'Manajemen Waktu untuk Mahasiswa Aktif Lomba',     'deskripsi' => 'Seimbangkan akademik, lomba, dan kehidupan sosial dengan sistem yang tepat.',    'thumbnail' => null, 'slug' => 'tips-3'],
        (object)['judul' => 'Tips Membangun Tim Lomba yang Solid',             'deskripsi' => 'Kemenangan lomba tim bukan soal siapa paling pintar, tapi siapa paling kompak.', 'thumbnail' => null, 'slug' => 'tips-4'],
        (object)['judul' => 'Strategi Menulis Proposal Lomba yang Menang',     'deskripsi' => 'Proposal yang baik adalah kunci lolos seleksi awal di hampir semua lomba.',      'thumbnail' => null, 'slug' => 'tips-5'],
        (object)['judul' => 'Cara Presentasi yang Percaya Diri di Depan Juri', 'deskripsi' => 'Kuasai teknik presentasi agar id kamu tersampaikan dengan jelas dan meyakinkan.','thumbnail' => null, 'slug' => 'tips-6'],
    ]);
    return view('tips', compact('tips'));
})->name('tips');

Route::get('/tentang',  fn () => view('tentang'))->name('tentang');
Route::get('/profile',  fn () => view('profile'))->name('profile');
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');