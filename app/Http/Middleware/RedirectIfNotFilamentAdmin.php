<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Http\Middleware\Authenticate as Middleware;

class RedirectIfNotFilamentAdmin extends Middleware
{
    /**
     * Jika user sudah login tapi bukan admin/collaborator (role reguler),
     * arahkan ke halaman utama FE bukan ke login page.
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $user = auth()->user();

        // Sudah login tapi bukan admin/collaborator → tolak akses panel, redirect ke FE
        if ($user && ! ($user->isAdmin() || $user->isCollaborator())) {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke panel admin.');
        }

        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Belum login sama sekali → arahkan ke halaman login FE
     */
    protected function redirectTo($request): ?string
    {
        return route('login');
    }
}
