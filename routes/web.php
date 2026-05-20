<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/detail-lomba', function () {
    return view('lomba.detail');
});

Route::get('/detail-seminar', function () {
    return view('seminar.detail');
});

Route::get('/feedback', function () {
    return view('feedback');
});

Route::get('/detail-beasiswa', function () {
    return view('beasiswa.detail');
});

Route::get('/bookmark', function (\Illuminate\Http\Request $request) {
    $items = collect();
    $categories = ['Lomba', 'Seminar', 'Beasiswa'];
    for ($i = 1; $i <= 42; $i++) {
        $items->push((object)[
            'id' => $i,
            'title' => 'Event ' . $categories[$i % 3] . ' Tingkat Nasional ' . $i,
            'category' => $categories[$i % 3],
            'date' => now()->addDays($i)->format('d M Y')
        ]);
    }
    
    // Filter by category if requested
    $filterCategory = $request->input('category');
    if ($filterCategory && $filterCategory !== 'Semua Kategori') {
        $items = $items->filter(function($item) use ($filterCategory) {
            return $item->category === $filterCategory;
        })->values(); // Reset keys
    }
    
    $perPage = 8;
    $page = $request->input('page', 1);
    
    $paginatedItems = new \Illuminate\Pagination\LengthAwarePaginator(
        $items->forPage($page, $perPage),
        $items->count(),
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('bookmark', [
        'bookmarks' => $paginatedItems,
        'currentCategory' => $filterCategory ?? 'Semua Kategori'
    ]);
});

Route::get('/diminati', function (\Illuminate\Http\Request $request) {
    $items = collect();
    $categories = ['Lomba', 'Seminar', 'Beasiswa'];
    for ($i = 1; $i <= 42; $i++) {
        $items->push((object)[
            'id' => $i,
            'title' => 'Event ' . $categories[$i % 3] . ' Tingkat Nasional ' . $i,
            'category' => $categories[$i % 3],
            'date' => now()->addDays($i)->format('d M Y')
        ]);
    }
    
    // Filter by category if requested
    $filterCategory = $request->input('category');
    if ($filterCategory && $filterCategory !== 'Semua Kategori') {
        $items = $items->filter(function($item) use ($filterCategory) {
            return $item->category === $filterCategory;
        })->values(); // Reset keys
    }
    
    $perPage = 8;
    $page = $request->input('page', 1);
    
    $paginatedItems = new \Illuminate\Pagination\LengthAwarePaginator(
        $items->forPage($page, $perPage),
        $items->count(),
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('diminati', [
        'bookmarks' => $paginatedItems,
        'currentCategory' => $filterCategory ?? 'Semua Kategori'
    ]);
});
