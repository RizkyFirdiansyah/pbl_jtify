<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse as Responsable;
use Illuminate\Http\RedirectResponse;

class LogoutResponse implements Responsable
{
    public function toResponse($request): RedirectResponse
    {
        if ($request->is('admin*')) {
            return redirect()->to('/admin/login');
        }
        return redirect()->to('/');
    }
}
