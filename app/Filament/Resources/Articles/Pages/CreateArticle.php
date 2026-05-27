<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        $data['user_id'] = $user?->id;

        if ($user instanceof User && $user->isCollaborator()) {
            // Kolaborator hanya boleh menyimpan status draft atau pending_review
            if (! in_array($data['status'] ?? 'draft', ['draft', 'pending_review'], true)) {
                $data['status'] = 'pending_review';
            }

            // Pastikan data approval tetap bersih
            $data['approved_by'] = null;
            $data['approved_at'] = null;
        }

        if ($user instanceof User && $user->isAdmin() && (($data['status'] ?? null) === 'published')) {
            $data['approved_by'] = $user->id;
            $data['approved_at'] = now();
        }

        return $data;
    }
}