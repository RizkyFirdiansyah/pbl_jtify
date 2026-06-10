<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            if (! Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated',
                ], 401);
            }

            $feedbacks = Feedback::query()
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(10);

            return response()->json([
                'success' => true,
                'data' => $feedbacks,
            ]);
        }

        if (! view()->exists('feature.feedback')) {
            return response()->json([
                'success' => true,
                'data' => [],
            ]);
        }

        return view('feature.feedback');
    }

    public function store(Request $request): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        if (! $user) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated',
                ], 401);
            }

            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengisi feedback.');
        }

        $validated = $request->validate([
            'message' => ['required', 'string', 'min:10'],
        ]);

        $feedback = Feedback::create([
            'user_id' => $user->id,
            'message' => $validated['message'],
            'status' => 'draft',
        ]);

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Feedback berhasil dikirim',
                'data' => $feedback->load('user'),
            ], 201);
        }

        return back()->with('success', 'Feedback berhasil dikirim');
    }

    public function show(string $id): JsonResponse
    {
        $feedback = Feedback::with('user')->find($id);

        if (! $feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $feedback,
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
            ], 401);
        }

        $feedback = Feedback::find($id);

        if (! $feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback not found',
            ], 404);
        }

        if ($feedback->user_id !== $user->id && ! $user->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $validated = $request->validate([
            'message' => ['sometimes', 'string', 'min:10'],
            'status' => ['sometimes', 'in:draft,archived,published'],
        ]);

        $feedback->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Feedback berhasil diperbarui',
            'data' => $feedback->fresh('user'),
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
            ], 401);
        }

        $feedback = Feedback::find($id);

        if (! $feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback not found',
            ], 404);
        }

        if ($feedback->user_id !== $user->id && ! $user->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $feedback->delete();

        return response()->json([
            'success' => true,
            'message' => 'Feedback berhasil dihapus',
        ]);
    }
}
