<?php

namespace App\Filament\Resources\SiteContents\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPageContents extends ListRecords
{
    protected static string $resource = 'App\\Filament\\Resources\\SiteContents\\PageContentResource';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
