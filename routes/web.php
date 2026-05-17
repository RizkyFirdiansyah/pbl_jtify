<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/bookmark', function () {
    return view('bookmark');
})->name('bookmark');

Route::get('/recruitment', function () {
    return view('recruitment');
})->name('recruitment');

Route::get('/lomba', function () {
    return view('lomba');
})->name('lomba');

Route::get('/seminar', function () {
    return view('seminar');
})->name('seminar');

Route::get('/beasiswa', function () {
    return view('beasiswa');
})->name('beasiswa');

Route::get('/peminatan', function () {
    return view('peminatan');
})->name('peminatan');

Route::get('/feedback', function () {
    return view('feedback');
})->name('feedback');

Route::get('/popular', function () {
    return view('index');
})->name('popular');

Route::get('/detail', function () {
    return view('detail');
})->name('detail');