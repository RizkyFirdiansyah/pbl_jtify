<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserProfileController extends Controller
{
    //Show user profile
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', ['user' => $user]);
    }

    //Show edit profile form
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', ['user' => $user]);
    }

    //Update user profile
    public function update(Request $request)
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

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    // Delete CV file
    public function deleteCv()
    {
        $user = User::find(Auth::id());

        if ($user->cv_path && Storage::disk('public')->exists($user->cv_path)) {
            Storage::disk('public')->delete($user->cv_path);
            $user->update(['cv_path' => null]);

            return redirect()
                ->route('profile.edit')
                ->with('success', 'CV berhasil dihapus!');
        }

        return redirect()
            ->route('profile.edit')
            ->with('error', 'CV tidak ditemukan!');
    }
}