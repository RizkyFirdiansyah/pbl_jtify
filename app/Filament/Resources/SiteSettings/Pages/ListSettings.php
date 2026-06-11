<?php

namespace App\Filament\Resources\SiteSettings\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = 'App\\Filament\\Resources\\SiteSettings\\SettingResource';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
