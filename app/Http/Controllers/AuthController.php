<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function showLogin()
  {
    return view('auth.login');
  }

  public function showRegister()
  {
    return view('auth.register');
  }

  public function login(Request $request): JsonResponse|\Illuminate\Http\RedirectResponse
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (! Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
      return $this->failedLoginResponse($request);
    }

    /** @var User|null $user */
    $user = Auth::guard('web')->user();

    if (! $user || $user->role !== 'reguler') {
      Auth::guard('web')->logout();
      return $this->failedLoginResponse($request, 'Akun bukan user reguler');
    }

    $request->session()->regenerate();

    if ($request->expectsJson() || $request->is('api/*')) {
      $token = $user->createToken('frontend')->plainTextToken;

      return response()->json([
        'success' => true,
        'message' => 'Login berhasil',
        'data' => [
          'user' => $user,
          'token' => $token,
          'token_type' => 'Bearer',
        ],
      ]);
    }

    return redirect()->intended('/');
  }

  public function register(Request $request): JsonResponse|\Illuminate\Http\RedirectResponse
  {
    $validated = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', 'max:255', 'unique:users,email'],
      'phone' => ['required', 'string', 'max:20'],
      'password' => ['required', 'string', 'min:6', 'confirmed'],
    ]);

    $user = User::create([
      'name' => $validated['name'],
      'email' => $validated['email'],
      'phone' => $validated['phone'],
      'password' => $validated['password'],
      'role' => 'reguler',
    ]);

    Auth::guard('web')->login($user);
    $request->session()->regenerate();

    if ($request->expectsJson() || $request->is('api/*')) {
      $token = $user->createToken('frontend')->plainTextToken;

      return response()->json([
        'success' => true,
        'message' => 'Registrasi berhasil',
        'data' => [
          'user' => $user,
          'token' => $token,
          'token_type' => 'Bearer',
        ],
      ], 201);
    }

    return redirect('/');
  }

  public function logout(Request $request): JsonResponse|\Illuminate\Http\RedirectResponse
  {
    $user = $request->user();

    if ($user && $user->currentAccessToken()) {
      $user->currentAccessToken()->delete();
    }

    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    if ($request->expectsJson() || $request->is('api/*')) {
      return response()->json([
        'success' => true,
        'message' => 'Logout berhasil',
      ]);
    }

    return redirect('/');
  }

  public function me(Request $request): JsonResponse
  {
    return response()->json([
      'success' => true,
      'data' => $request->user(),
    ]);
  }

  private function failedLoginResponse(Request $request, string $message = 'Email/password salah'): JsonResponse|\Illuminate\Http\RedirectResponse
  {
    if ($request->expectsJson() || $request->is('api/*')) {
      return response()->json([
        'success' => false,
        'message' => $message,
      ], 422);
    }

    return back()->withErrors(['email' => $message]);
  }
}
