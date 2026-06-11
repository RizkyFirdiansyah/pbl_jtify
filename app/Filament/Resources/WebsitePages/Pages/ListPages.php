<?php

namespace App\Filament\Resources\WebsitePages\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    protected static string $resource = 'App\\Filament\\Resources\\WebsitePages\\PageResource';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
