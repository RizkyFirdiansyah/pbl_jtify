<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CollaboratorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ============================================================
// HALAMAN UTAMA
// ============================================================

Route::get('/', function () {
    $dbTips = \App\Models\Article::where('status', 'published')->latest()->take(4)->get();
    $tips = $dbTips->map(fn($item) => (object)[
        'judul' => $item->title,
        'deskripsi' => \Illuminate\Support\Str::limit(strip_tags($item->content), 100),
        'thumbnail' => $item->poster_path,
        'slug' => $item->slug
    ]);

    $feedbacks = \App\Models\Feedback::where('status', 'published')->with('user')->latest()->take(6)->get();

    return view('index', compact('tips', 'feedbacks'));
})->name('home');

// ============================================================
// AUTH
// ============================================================

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:5,1');
    Route::get('/register', fn () => view('auth.register'))->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ============================================================
// NOTIFIKASI AJAX ENDPOINTS
// ============================================================
Route::middleware('auth')->group(function () {
    Route::post('/notifications/{id}/read', function ($id) {
        $notif = auth()->user()->userNotifications()->findOrFail($id);
        $notif->update(['is_read' => true]);
        return response()->json(['success' => true]);
    });
    
    Route::delete('/notifications/{id}', function ($id) {
        $notif = auth()->user()->userNotifications()->findOrFail($id);
        $notif->delete();
        return response()->json(['success' => true]);
    });
    
    Route::post('/notifications/clear', function () {
        auth()->user()->userNotifications()->delete();
        return response()->json(['success' => true]);
    });
});

// ============================================================
// LOMBA, BEASISWA, SEMINAR
// ============================================================

Route::get('/lomba', function (Request $request) {
    $q = trim($request->get('q', ''));
    
    $query = \App\Models\Information::whereHas('category', fn($c) => $c->where('slug', 'lomba'))
        ->where('status', 'published');

    if (!empty($q)) {
        $query->where('title', 'like', '%' . $q . '%');
    }

    $dbItems = $query->latest()->get();

    $lombaData = $dbItems->map(fn($item) => [
        'id' => $item->id,
        'title' => $item->title,
        'deadline' => $item->deadline->format('d M Y'),
        'poster_path' => $item->poster_path,
    ]);

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

Route::get('/beasiswa', function (Request $request) {
    $q = trim($request->get('q', ''));
    
    $query = \App\Models\Information::whereHas('category', fn($c) => $c->where('slug', 'beasiswa'))
        ->where('status', 'published');

    if (!empty($q)) {
        $query->where('title', 'like', '%' . $q . '%');
    }

    $dbItems = $query->latest()->get();

    $beasiswaData = $dbItems->map(fn($item) => [
        'id' => $item->id,
        'title' => $item->title,
        'deadline' => $item->deadline->format('d M Y'),
        'poster_path' => $item->poster_path,
    ]);

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

Route::get('/seminar', function (Request $request) {
    $q = trim($request->get('q', ''));
    
    $query = \App\Models\Information::whereHas('category', fn($c) => $c->where('slug', 'seminar'))
        ->where('status', 'published');

    if (!empty($q)) {
        $query->where('title', 'like', '%' . $q . '%');
    }

    $dbItems = $query->latest()->get();

    $seminarData = $dbItems->map(fn($item) => [
        'id' => $item->id,
        'title' => $item->title,
        'deadline' => $item->deadline->format('d M Y'),
        'poster_path' => $item->poster_path,
    ]);

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
// BOOKMARK
// ============================================================

Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark');

// ============================================================
// PEMINATAN
// ============================================================

Route::get('/peminatan', [LikeController::class, 'index'])->name('peminatan');
Route::get('/diminati', [LikeController::class, 'index'])->name('diminati');

// ============================================================
// TIPS
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
    
    $tipsData = $dbTips->map(fn($item) => [
        'slug'        => $item->slug,
        'title'       => $item->title,
        'description' => \Illuminate\Support\Str::limit(strip_tags($item->content), 120),
        'date'        => $item->approved_at ? $item->approved_at->format('d M Y') : $item->created_at->format('d M Y'),
        'poster_path' => $item->poster_path,
    ]);
    
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
    $article = \App\Models\Article::where('slug', $slug)->where('status', 'published')->firstOrFail();
    
    $tip = [
        'slug'        => $article->slug,
        'title'       => $article->title,
        'date'        => $article->approved_at ? $article->approved_at->format('d M Y') : $article->created_at->format('d M Y'),
        'author'      => $article->user?->name ?? 'Admin',
        'author_role' => $article->user?->role ?? 'Penulis',
        'poster_path' => $article->poster_path,
        'content'     => array_filter(explode("\n\n", $article->content))
    ];
    
    $dbRec = \App\Models\Article::where('id', '!=', $article->id)
        ->where('status', 'published')
        ->latest()
        ->take(3)
        ->get();
        
    $recommendations = $dbRec->map(fn($item) => [
        'slug'        => $item->slug,
        'title'       => $item->title,
        'date'        => $item->approved_at ? $item->approved_at->format('d M Y') : $item->created_at->format('d M Y'),
        'poster_path' => $item->poster_path,
    ])->toArray();

    return view('tips.detail', compact('tip', 'recommendations'));
})->name('tips.detail');

// ============================================================
// HALAMAN LAIN
// ============================================================

Route::get('/tentang', fn () => view('about.tentang'))->name('tentang');

Route::get('/profile', fn () => view('feature.profile'))
    ->middleware('auth')
    ->name('profile');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// COLLABORATOR
Route::get('/collaborator/register', [CollaboratorController::class, 'showRegistrationForm'])
    ->name('collaborator.register');

Route::post('/collaborator/register', [CollaboratorController::class, 'storeRegistration'])
    ->middleware('auth')
    ->name('collaborator.register.store');