<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Information;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        $query = Bookmark::query()
            ->with(['information.category'])
            ->when(Auth::check(), fn($builder) => $builder->where('user_id', Auth::id()), fn($builder) => $builder->whereRaw('1 = 0'));

        if ($request->filled('category') && $request->category !== 'Semua Kategori') {
            $query->whereHas('information.category', function ($builder) use ($request) {
                $builder->where('slug', $request->category);
            });
        }

        $bookmarks = $query->latest()->get()->map(function (Bookmark $bookmark) {
            return (object) [
                'id' => $bookmark->id,
                'information_id' => $bookmark->information_id,
                'title' => $bookmark->information?->title ?? '-',
                'category' => $bookmark->information?->category?->name ?? '-',
                'date' => $bookmark->information?->deadline?->format('d M Y') ?? '-',
                'reminder_enabled' => (bool) $bookmark->reminder_enabled,
                'poster_path' => $bookmark->information?->poster_path,
            ];
        });

        $page = (int) $request->input('page', 1);
        $perPage = 8;
        $paginated = new LengthAwarePaginator(
            $bookmarks->forPage($page, $perPage)->values(),
            $bookmarks->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        if ($request->expectsJson() || $request->is('api/*') || ! view()->exists('feature.bookmark')) {
            return response()->json([
                'success' => true,
                'data' => $paginated,
            ]);
        }

        return view('feature.bookmark', [
            'bookmarks' => $paginated,
            'currentCategory' => $request->input('category', 'Semua Kategori'),
        ]);
    }

    //Toggle bookmark dan reminder untuk informasi
    public function toggle(Request $request): JsonResponse
    {
        $request->validate([
            'information_id' => 'required|exists:information,id',
            'reminder_enabled' => 'nullable|boolean',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $information = Information::find($request->information_id);
        if (!$information) {
            return response()->json(['message' => 'Information not found'], 404);
        }

        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('information_id', $information->id)
            ->first();

        if ($bookmark) {
            // Jika bookmark sudah ada, update reminder_enabled jika disediakan, atau toggle bookmark jika tidak
            if ($request->has('reminder_enabled')) {
                $bookmark->update(['reminder_enabled' => $request->reminder_enabled]);
                $isBookmarked = true;
                $reminderEnabled = $bookmark->reminder_enabled ?? false;
            } else {
                // Kalau tidak, toggle bookmark
                $bookmark->delete();
                $isBookmarked = false;
                $reminderEnabled = false;
            }
        } else {
            // Buat bookmark baru
            $reminderEnabled = $request->reminder_enabled ?? false;
            Bookmark::create([
                'user_id' => $user->id,
                'information_id' => $information->id,
                'reminder_enabled' => $reminderEnabled,
            ]);
            $isBookmarked = true;
        }

        return response()->json([
            'message' => $isBookmarked ? 'Disimpan' : 'Batal disimpan',
            'is_bookmarked' => $isBookmarked,
            'reminder_enabled' => $reminderEnabled ?? false,
        ]);
    }

    //Mengecek apakah user sudah bookmark informasi ini
    public function check(Request $request): JsonResponse
    {
        $request->validate([
            'information_id' => 'required|exists:information,id',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('information_id', $request->information_id)
            ->first();

        return response()->json([
            'is_bookmarked' => $bookmark !== null,
            'reminder_enabled' => $bookmark?->reminder_enabled ?? false,
        ]);
    }

    //Update hanya reminder_enabled status untuk bookmark yang sudah ada
    public function updateReminder(Request $request): JsonResponse
    {
        $request->validate([
            'information_id' => 'required|exists:information,id',
            'reminder_enabled' => 'required|boolean',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('information_id', $request->information_id)
            ->first();

        if (!$bookmark) {
            return response()->json(['message' => 'Bookmark not found'], 404);
        }

        $bookmark->update(['reminder_enabled' => $request->reminder_enabled]);

        return response()->json([
            'message' => 'Reminder ' . ($request->reminder_enabled ? 'diaktifkan' : 'dinonaktifkan'),
            'reminder_enabled' => $bookmark->reminder_enabled,
        ]);
    }
}
