<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Information;

class TopTreeBeasiswa extends ChartWidget
{
    protected ?string $heading = 'Top 3 Beasiswa Peminat Terbanyak';

    protected static ?int $sort = 7;

    protected int | string | array $columnSpan = 4;

    protected function getData(): array
    {
        $topInformations = Information::withCount('interests')
            ->where('category_id', 3)
            ->orderByDesc('interests_count')
            ->take(3)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Peminat',
                    'data' => $topInformations->pluck('interests_count')->toArray(),
                    'backgroundColor' => 'rgba(245, 158, 11, 0.5)',
                    'borderColor' => '#f59e0b',
                    'borderWidth' => 2,
                ],
            ],

            'labels' => $topInformations->pluck('title')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',

            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],

            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
    protected function getMaxHeight(): string
    {
        return '250px';
    }
    
}