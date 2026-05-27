<?php

namespace App\Filament\Resources\Likes\Pages;

use App\Filament\Resources\Likes\LikeResource;
use Filament\Resources\Pages\ViewRecord;

class ViewLike extends ViewRecord
{
    protected static string $resource = LikeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
