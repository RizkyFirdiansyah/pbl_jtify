<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use App\Models\Information;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalInformationByCategory extends StatsOverviewWidget
{
    protected function getColumns(): int
    {
        return 3;
    }
    protected function getStats(): array
    {
        $totalWorkshop = Information::where('category_id', 1)->count();
        $totalLomba = Information::where('category_id', 2)->count(); 
        $totalBeasiswa = Information::where('category_id', 3)->count();

        return [
            Stat::make('Total Workshop', $totalWorkshop)
                ->description('Jumlah informasi workshop yang tersedia')
                ->color('primary')
                ->icon('heroicon-o-academic-cap')
                ->url(route('filament.admin.resources.information.index')),
            Stat::make('Total Lomba', $totalLomba)
                ->description('Jumlah informasi lomba yang tersedia')
                ->color('success')
                ->icon('heroicon-o-trophy')
                ->url(route('filament.admin.resources.information.index')),
            Stat::make('Total Beasiswa', $totalBeasiswa)
                ->description('Jumlah informasi beasiswa yang tersedia')
                ->color('warning')
                ->icon('heroicon-o-book-open')
                ->url(route('filament.admin.resources.information.index')),
        ];
    }
}
