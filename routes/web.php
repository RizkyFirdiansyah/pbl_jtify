<?php

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

// ============================================================
// HALAMAN UTAMA
// ============================================================

Route::get('/', fn () => view('index'))->name('home');

Route::get('/popular', fn () => view('index'))->name('popular');

Route::get('/recruitment', fn () => view('recruitment'))->name('recruitment');

Route::get('/feedback', fn () => view('feedback'))->name('feedback');

// ============================================================
// LOMBA
// ============================================================

Route::get('/lomba', fn () => view('lomba.index'))->name('lomba');

Route::get('/detail-lomba', fn () => view('lomba.detail'))->name('lomba.detail');

// ============================================================
// BEASISWA
// ============================================================

Route::get('/beasiswa', fn () => view('beasiswa.index'))->name('beasiswa');

Route::get('/detail-beasiswa', fn () => view('beasiswa.detail'))->name('beasiswa.detail');

// ============================================================
// SEMINAR
// ============================================================

Route::get('/seminar', fn () => view('seminar.index'))->name('seminar');

Route::get('/detail-seminar', fn () => view('seminar.detail'))->name('seminar.detail');

// ============================================================
// BOOKMARK
// ============================================================

Route::get('/bookmark', function (Request $request) {
    $items = _buildPaginatedItems($request);

    return view('bookmark', [
        'bookmarks'       => $items['paginated'],
        'currentCategory' => $items['category'],
    ]);
})->name('bookmark');

// ============================================================
// PEMINATAN / DIMINATI
// ============================================================

/**
 * Shared handler untuk route /peminatan dan /diminati.
 * Membuat daftar event dummy, memfilter berdasarkan kategori,
 * lalu mengembalikan view peminatan dengan data terpaginasi.
 */
$peminatanHandler = function (Request $request) {
    $items = _buildPaginatedItems($request);

    return view('peminatan', [
        'bookmarks'       => $items['paginated'],
        'currentCategory' => $items['category'],
    ]);
};

Route::get('/peminatan', $peminatanHandler)->name('peminatan');
Route::get('/diminati', $peminatanHandler)->name('diminati');

    // // ============================================================
    // // DETAIL GENERIC
    // // ============================================================

    // Route::get('/detail', fn () => view('detail'))->name('detail');
