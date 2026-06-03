<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Information;
use Filament\Widgets\ChartWidget;


class InformationByCategoryChart extends ChartWidget
{
    protected ?string $heading = 'Total Informasi Per Kategori';

    protected ?string $maxHeight = '300px';

    protected array|string|int $columnSpan = '1';

    protected function getData(): array
    {
        $data = Category::withCount('informations')
            ->orderBy('informations_count', 'desc')
            ->get();

        $labels = $data->pluck('name')->toArray();
        $counts = $data->pluck('informations_count')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total Informasi',
                    'data' => $counts,
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.5)',
                        'rgba(34, 197, 94, 0.5)',
                        'rgba(251, 146, 60, 0.5)',
                        'rgba(168, 85, 247, 0.5)',
                        'rgba(236, 72, 153, 0.5)',
                    ],
                    'borderColor' => [
                        'rgba(59, 130, 246, 1)',
                        'rgba(34, 197, 94, 1)',
                        'rgba(251, 146, 60, 1)',
                        'rgba(168, 85, 247, 1)',
                        'rgba(236, 72, 153, 1)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'offset' => true,  
                    'ticks' => [
                        'padding' => 10, 
                    ],
                ],
                'y' => [
                    'ticks' => [
                        'padding' => 8,  
                    ],
                ],
            ],
            'layout' => [
                'padding' => [
                    'left' => 20,       
                ],
            ],
        ];
    }
}
