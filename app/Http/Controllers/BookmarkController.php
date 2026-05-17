<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Information;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
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
            } else {
                // Kalau tidak, toggle bookmark
                $bookmark->delete();
            }
            $isBookmarked = $bookmark->exists();
            $reminderEnabled = $bookmark->reminder_enabled ?? false;
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
            'message' => $isBookmarked ? 'Disimpan ke bookmark' : 'Dihapus dari bookmark',
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
