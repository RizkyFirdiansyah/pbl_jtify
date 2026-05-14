<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\Information;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InterestController extends Controller
{
    
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
