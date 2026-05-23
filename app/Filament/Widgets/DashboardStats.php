<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        // Statistik pengguna
        $stats = [
            Stat::make('Admin', User::where('role', 'admin')->count())
                ->description('Total Administrator')
                ->color('success')
                ->icon('heroicon-o-shield-check'),

            Stat::make('Collaborator', User::where('role', 'collabolator')->count())
                ->description('Total Kolaborator')
                ->color('primary')
                ->icon('heroicon-o-user-group'),

            Stat::make('User Reguler', User::where('role', 'reguler')->count())
                ->description('Total Pengguna')
                ->color('warning')
                ->icon('heroicon-o-users'),
        ];

        // Statistik informasi per kategori
        $categories = Category::withCount('informations')->get();
        foreach ($categories as $category) {
            $stats[] = Stat::make($category->name, $category->informations_count)
                ->description('Informasi')
                ->color('info')
                ->icon('heroicon-o-document-text');
        }

        return $stats;
    }
}