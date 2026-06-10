<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CollaboratorController extends Controller
{
    public function showRegistrationForm()
    {
        $user = Auth::user();

        // Guest view
        if (!$user) {
            return view('auth.collaborator-register', [
                'state' => 'guest'
            ]);
        }

        // Admin/Collaborator already has role
        if ($user->isAdmin() || $user->isCollaborator()) {
            return view('auth.collaborator-register', [
                'state' => 'active_role',
                'user' => $user
            ]);
        }

        // Check if there is an application
        $pendingRequest = Collaborator::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($pendingRequest) {
            return view('auth.collaborator-register', [
                'state' => 'pending',
                'user' => $user,
                'request' => $pendingRequest
            ]);
        }

        // Regular user with no pending requests can submit a new one
        return view('auth.collaborator-register', [
            'state' => 'form',
            'user' => $user
        ]);
    }

    public function storeRegistration(Request $request)
    {
        $user = User::find(Auth::id());
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Double check pending
        $hasPending = Collaborator::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();
        if ($hasPending) {
            return back()->with('error', 'Pengajuan kolaborator Anda sedang dalam proses peninjauan.');
        }

        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'linkedin_url' => 'nullable|url|max:255',
            'reason' => 'required|string|min:20',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'phone.required' => 'Nomor telepon wajib diisi.',
            'reason.required' => 'Alasan pengajuan wajib diisi.',
            'reason.min' => 'Alasan pengajuan minimal harus 20 karakter.',
            'linkedin_url.url' => 'Format URL LinkedIn tidak valid.',
            'cv.mimes' => 'Format berkas CV harus PDF, DOC, atau DOCX.',
            'cv.max' => 'Ukuran berkas CV maksimal 5MB.',
        ]);

        // Handle CV upload if provided
        if ($request->hasFile('cv')) {
            // Delete old CV if exists
            if ($user->cv_path && Storage::disk('public')->exists($user->cv_path)) {
                Storage::disk('public')->delete($user->cv_path);
            }

            $path = $request->file('cv')->store('cvs', 'public');
            $user->cv_path = $path;
        }

        // Update other fields on user
        $user->phone = $validated['phone'];
        $user->linkedin_url = $validated['linkedin_url'];
        $user->save();

        // Create collaborator request
        Collaborator::create([
            'user_id' => $user->id,
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);

        return redirect()->route('collaborator.register')->with('success', 'Pengajuan kolaborator berhasil dikirim! Silakan menunggu persetujuan admin.');
    }
}
