<?php

namespace App\Filament\Resources\Interests\Pages;

use Filament\Resources\Pages\ListRecords;

class ListInterests extends ListRecords
{
  protected static string $resource = 'App\\Filament\\Resources\\Interests\\InterestResource';

  protected function getHeaderActions(): array
  {
    return [];
  }
}
