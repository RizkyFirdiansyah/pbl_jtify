<?php

namespace App\Filament\Widgets;

use App\Models\Information;
use Filament\Widgets\ChartWidget;

class TopTreeLomba extends ChartWidget
{
    protected ?string $heading = 'Top 3 Lomba Peminat Terbanyak';

    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 4;

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
                    'backgroundColor' => 'rgba(16, 185, 129, 0.5)',
                    'borderColor' => '#10b981',
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