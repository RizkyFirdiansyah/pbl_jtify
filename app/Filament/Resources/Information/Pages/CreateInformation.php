<?php

namespace App\Filament\Resources\Information\Pages;

use App\Filament\Resources\Information\InformationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInformation extends CreateRecord
{
    protected static string $resource = InformationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        $data['user_id'] = $user?->id;

        if ($user instanceof User && $user->isCollaborator()) {
            if (! in_array($data['status'] ?? 'draft', ['draft', 'pending_review'], true)) {
                $data['status'] = 'pending_review';
            }

            $data['approved_by'] = null;
            $data['approved_at'] = null;
        }

        if ($user instanceof User && $user->isSuperAdmin() && (($data['status'] ?? null) === 'published')) {
            $data['approved_by'] = $user->id;
            $data['approved_at'] = now();
        }

        return $data;
    }
}
