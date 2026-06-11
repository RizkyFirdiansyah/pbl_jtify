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
                'consented_at' => $interest->consented_at?->format('d M Y H:i'),
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

    public function toggle(Request $request): JsonResponse
    {
        $request->validate([
            'information_id' => 'required|exists:information,id',
            'consented' => 'sometimes|boolean',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $information = Information::where('id', $request->information_id)
            ->where('status', 'published')
            ->first();
        if (!$information) {
            return response()->json(['message' => 'Information not found or not published'], 404);
        }

        $interest = Interest::where('user_id', $user->id)
            ->where('information_id', $information->id)
            ->first();

        if ($interest) {
            $newStatus = $interest->status === 'active' ? 'cancelled' : 'active';
            $interest->update([
                'status' => $newStatus,
                'consented_at' => $request->boolean('consented') && ! $interest->consented_at ? now() : $interest->consented_at,
            ]);
            $isActive = $newStatus === 'active';
        } else {
            if (! $request->boolean('consented')) {
                return response()->json([
                    'message' => 'Persetujuan diperlukan sebelum daftar',
                ], 422);
            }

            Interest::create([
                'user_id' => $user->id,
                'information_id' => $information->id,
                'status' => 'active',
                'consented_at' => now(),
            ]);
            $isActive = true;
        }

        return response()->json([
            'message' => $isActive ? 'Daftar berhasil' : 'Pendaftaran dibatalkan',
            'is_active' => $isActive,
            'count' => $information->interests()->where('status', 'active')->count(),
            'registration_link' => $information->registration_link,
        ]);
    }

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

