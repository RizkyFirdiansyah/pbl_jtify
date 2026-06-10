<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Information;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LikeController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        $query = Like::query()
            ->with(['information.category'])
            ->where('status', 'active')
            ->when(Auth::check(), fn($builder) => $builder->where('user_id', Auth::id()), fn($builder) => $builder->whereRaw('1 = 0'));

        if ($request->filled('category') && $request->category !== 'Semua Kategori') {
            $query->whereHas('information.category', function ($builder) use ($request) {
                $builder->where('slug', $request->category);
            });
        }

        $likes = $query->latest()->get()->map(function (Like $like) {
            return (object) [
                'id' => $like->id,
                'information_id' => $like->information_id,
                'title' => $like->information?->title ?? '-',
                'category' => $like->information?->category?->name ?? '-',
                'date' => $like->information?->deadline?->format('d M Y') ?? '-',
                'status' => $like->status,
            ];
        });

        $page = (int) $request->input('page', 1);
        $perPage = 8;
        $paginated = new LengthAwarePaginator(
            $likes->forPage($page, $perPage)->values(),
            $likes->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        if ($request->expectsJson() || $request->is('api/*') || ! view()->exists('feature.peminatan')) {
            return response()->json([
                'success' => true,
                'data' => $paginated,
            ]);
        }

        return view('feature.peminatan', [
            'bookmarks' => $paginated,
            'currentCategory' => $request->input('category', 'Semua Kategori'),
        ]);
    }


    //Toggle peminatan user terhadap informasi.
    //Jika belum ada maka create active
    //Jika sudah active maka ubah ke cancelled
    //Jika cancelled maka ubah ke active
    public function toggle(Request $request): JsonResponse
    {
        $request->validate([
            'information_id' => 'required|exists:information,id',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $information = Information::find($request->information_id);
        if (!$information) {
            return response()->json(['message' => 'Information not found'], 404);
        }

        // Cek apakah sudah ada like
        $like = Like::where('user_id', $user->id)
            ->where('information_id', $information->id)
            ->first();

        if ($like) {
            // Toggle status
            $newStatus = $like->status === 'active' ? 'cancelled' : 'active';
            $like->update([
                'status' => $newStatus,
            ]);
            $isActive = $newStatus === 'active';
        } else {
            // Buat baru dengan status active
            Like::create([
                'user_id' => $user->id,
                'information_id' => $information->id,
                'status' => 'active',
            ]);
            $isActive = true;
        }

        return response()->json([
            'message' => $isActive ? 'Minat ditambahkan' : 'Minat dibatalkan',
            'is_active' => $isActive,
            'count' => $information->likes()->where('status', 'active')->count(),
        ]);
    }


    // admin listing of likers is intentionally not present here; interests handle registration lists


    //Mengecekapakah user sudah punya like untuk information tertentu
    public function check(Request $request): JsonResponse
    {
        $request->validate([
            'information_id' => 'required|exists:information,id',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $like = Like::where('user_id', $user->id)
            ->where('information_id', $request->information_id)
            ->first();

        return response()->json([
            'has_like' => $like !== null,
            'is_active' => $like?->status === 'active',
            'status' => $like?->status,
        ]);
    }
}
