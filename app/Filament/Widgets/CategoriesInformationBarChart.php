<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class CategoriesInformationBarChart extends ChartWidget
{
    protected ?string $heading = 'Perbandingan Total Informasi Per Kategori';

    protected ?string $maxHeight = '350px';

    protected array|string|int $columnSpan = '2';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $categories = Category::withCount('informations')
            ->orderBy('informations_count', 'desc')
            ->get();

        $labels = $categories->pluck('name')->toArray();
        $counts = $categories->pluck('informations_count')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total Informasi',
                    'data' => $counts,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
                    'borderColor' => 'rgba(59, 130, 246, 1)',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
