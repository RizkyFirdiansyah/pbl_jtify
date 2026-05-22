<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    //Show user profile
    public function show(Request $request): JsonResponse|View
    {
        $user = Auth::user();

        if ($request->expectsJson() || $request->is('api/*') || ! view()->exists('profile.show')) {
            return response()->json([
                'success' => true,
                'data' => $user,
            ]);
        }

        return view('profile.show', ['user' => $user]);
    }

    //Show edit profile form
    public function edit(Request $request): JsonResponse|View
    {
        $user = Auth::user();

        if ($request->expectsJson() || $request->is('api/*') || ! view()->exists('profile.edit')) {
            return response()->json([
                'success' => true,
                'data' => $user,
            ]);
        }

        return view('profile.edit', ['user' => $user]);
    }

    //Update user profile
    public function update(Request $request): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $user = User::find(Auth::id());

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'phone'        => 'nullable|string|max:20',
            'linkedin_url' => 'nullable|url|max:255',
            'cv_path'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // hanya PDF, 5MB max
        ]);

        // Handle CV upload
        if ($request->hasFile('cv_path')) {
            // Hapus CV lama jika ada
            if ($user->cv_path && Storage::disk('public')->exists($user->cv_path)) {
                Storage::disk('public')->delete($user->cv_path);
            }

            // Simpan CV baru ke disk 'public' agar bisa diakses oleh Filament juga
            $path = $request->file('cv_path')->store('cvs', 'public');
            $validated['cv_path'] = $path;
        }

        $user->update($validated);

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui!',
                'data' => $user->fresh(),
            ]);
        }

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    // Delete CV file
    public function deleteCv(Request $request): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $user = User::find(Auth::id());

        if ($user->cv_path && Storage::disk('public')->exists($user->cv_path)) {
            Storage::disk('public')->delete($user->cv_path);
            $user->update(['cv_path' => null]);

            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => true,
                    'message' => 'CV berhasil dihapus!',
                    'data' => $user->fresh(),
                ]);
            }

            return redirect()
                ->route('profile.edit')
                ->with('success', 'CV berhasil dihapus!');
        }

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => false,
                'message' => 'CV tidak ditemukan!',
            ], 404);
        }

        return redirect()
            ->route('profile.edit')
            ->with('error', 'CV tidak ditemukan!');
    }

    public function feedbacks(Request $request): JsonResponse
    {
        $user = Auth::user();

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
            ], 401);
        }

        $feedbacks = Feedback::query()
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $feedbacks,
        ]);
    }
}
