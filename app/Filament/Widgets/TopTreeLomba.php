<?php

namespace App\Filament\Widgets;

use App\Models\Information;
use Filament\Widgets\ChartWidget;

class TopTreeLomba extends ChartWidget
{
    protected ?string $heading = 'Top 3 Lomba Peminat Terbanyak';

    // protected int|string|array $columnSpan = 1;
    protected int | string | array $columnSpan = [
    'md' => 2,
    'xl' => 1,
];

    protected function getData(): array
    {
        $topInformations = Information::withCount('interests')
            ->where('category_id', 2)
            ->orderByDesc('interests_count')
            ->take(3)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Peminat',
                    'data' => $topInformations->pluck('interests_count')->toArray(),
                    'backgroundColor' => 'rgba(34, 197, 94, 0.5)',
                    'borderColor' => 'rgba(34, 197, 94, 1)',
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

        protected function getMaxWeidth(): string
    {
        return '150px';
    }
}