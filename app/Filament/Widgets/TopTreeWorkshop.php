<?php

namespace App\Filament\Widgets;
use App\Models\Information;

use Filament\Widgets\ChartWidget;

class TopTreeWorkshop extends ChartWidget
{
    protected ?string $heading = 'Top 3 Workshop Peminat Terbanyak';

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 4;

    protected function getData(): array
    {
        $topInformations = Information::withCount('interests')
            ->where('category_id', 1)
            ->orderByDesc('interests_count')
            ->take(3)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Peminat',
                    'data' => $topInformations->pluck('interests_count')->toArray(),
                    'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
                    'borderColor' => '#3b82f6',
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