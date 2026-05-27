<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LikeController;
use Illuminate\Http\Request;
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

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');

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

Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark');

// ============================================================
// PEMINATAN / DIMINATI
// ============================================================

Route::get('/peminatan', [LikeController::class, 'index'])->name('peminatan');
Route::get('/diminati', [LikeController::class, 'index'])->name('diminati');

    // // ============================================================
    // // DETAIL GENERIC
    // // ============================================================

    // Route::get('/detail', fn () => view('detail'))->name('detail');
