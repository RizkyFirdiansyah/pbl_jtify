<?php

namespace App\Filament\Resources\Information\Pages;

use App\Filament\Resources\Information\InformationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EditInformation extends EditRecord
{
    protected static string $resource = InformationResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = Auth::user();

        if ($user instanceof User && $user->isCollaborator()) {
            if (! in_array($data['status'] ?? 'draft', ['draft', 'pending_review'], true)) {
                $data['status'] = 'pending_review';
            }

            $data['approved_by'] = null;
            $data['approved_at'] = null;
        }

        if ($user instanceof User && $user->isAdmin()) {
            if (($data['status'] ?? null) === 'published') {
                $data['approved_by'] = $user->id;
                $data['approved_at'] = now();
            }

            if (($data['status'] ?? null) !== 'published') {
                $data['approved_by'] = null;
                $data['approved_at'] = null;
            }
        }

        return $data;
    }


    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
