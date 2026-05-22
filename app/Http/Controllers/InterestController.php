<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\Information;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InterestController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        $query = Interest::query()
            ->with(['information.category'])
            ->where('status', 'active')
            ->when(Auth::check(), fn($builder) => $builder->where('user_id', Auth::id()), fn($builder) => $builder->whereRaw('1 = 0'));

        if ($request->filled('category') && $request->category !== 'Semua Kategori') {
            $query->whereHas('information.category', function ($builder) use ($request) {
                $builder->where('slug', $request->category);
            });
        }

        $interests = $query->latest()->get()->map(function (Interest $interest) {
            return (object) [
                'id' => $interest->id,
                'title' => $interest->information?->title ?? '-',
                'category' => $interest->information?->category?->name ?? '-',
                'date' => $interest->information?->deadline?->format('d M Y') ?? '-',
                'status' => $interest->status,
            ];
        });

        $page = (int) $request->input('page', 1);
        $perPage = 8;
        $paginated = new LengthAwarePaginator(
            $interests->forPage($page, $perPage)->values(),
            $interests->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        if ($request->expectsJson() || $request->is('api/*') || ! view()->exists('peminatan')) {
            return response()->json([
                'success' => true,
                'data' => $paginated,
            ]);
        }

        return view('peminatan', [
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

        // Cek apakah sudah ada interest
        $interest = Interest::where('user_id', $user->id)
            ->where('information_id', $information->id)
            ->first();

        if ($interest) {
            // Toggle status
            $newStatus = $interest->status === 'active' ? 'cancelled' : 'active';
            $interest->update(['status' => $newStatus]);
            $isActive = $newStatus === 'active';
        } else {
            // Buat baru dengan status active
            Interest::create([
                'user_id' => $user->id,
                'information_id' => $information->id,
                'status' => 'active',
            ]);
            $isActive = true;
        }

        return response()->json([
            'message' => $isActive ? 'Minat ditambahkan' : 'Minat dibatalkan',
            'is_active' => $isActive,
            'count' => $information->interests()->where('status', 'active')->count(),
        ]);
    }


    //Get daftar peminat per informasi (hanya admin)
    public function getByInformation(Information $information): JsonResponse
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $interests = $information->interests()
            ->where('status', 'active')
            ->with(['user' => function ($query) {
                $query->select('id', 'name', 'email', 'phone', 'linkedin_url');
            }])
            ->get();

        return response()->json([
            'information_id' => $information->id,
            'information_title' => $information->title,
            'count' => $interests->count(),
            'interests' => $interests,
        ]);
    }


    //Mengecekapakah user sudah punya interest untuk information tertentu
    public function check(Request $request): JsonResponse
    {
        $request->validate([
            'information_id' => 'required|exists:information,id',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $interest = Interest::where('user_id', $user->id)
            ->where('information_id', $request->information_id)
            ->first();

        return response()->json([
            'has_interest' => $interest !== null,
            'is_active' => $interest?->status === 'active',
            'status' => $interest?->status,
        ]);
    }
}
