<?php

namespace App\Filament\Widgets;

use App\Models\Interest;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;

class TopRecruitmentsByInterestWidget extends ChartWidget
{
    protected ?string $heading = 'Top 3 Lomba Peminat Terbanyak';

    protected ?string $maxHeight = '400px';

    protected array|string|int $columnSpan = '2';

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

    protected function getData(): array
    {
        $oneMonthAgo = now()->subMonth();

        $topRecruitments = Interest::where('created_at', '>=', $oneMonthAgo)
            ->with(['information' => function ($query) {
                $query->select('id', 'title');
            }])
            ->select('information_id', DB::raw('COUNT(*) as interest_count'))
            ->groupBy('information_id')
            ->orderByDesc('interest_count')
            ->limit(3)
            ->get();

        $labels = $topRecruitments->map(function ($item) {
            return $item->information ? $item->information->title : 'Unknown';
        })->toArray();

        $counts = $topRecruitments->pluck('interest_count')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Peminat',
                    'data' => $counts,
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                    ],
                    'borderColor' => [
                        'rgba(59, 130, 246, 1)',
                        'rgba(34, 197, 94, 1)',
                        'rgba(251, 146, 60, 1)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
