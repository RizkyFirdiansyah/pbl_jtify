<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class TotalUser extends ChartWidget
{
    protected ?string $heading = 'Total User';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 3;

    protected function getData(): array
    {
        $admin = User::where('role', 'admin')->count();

        $collaborator = User::where('role', 'collaborator')->count();

        $reguler = User::where('role', 'reguler')->count();

        return [
            'datasets' => [
                [
                    'data' => [
                        $admin,
                        $collaborator,
                        $reguler,
                    ],
                    'backgroundColor' => [
                        '#ef4444', // merah -> admin
                        '#3b82f6', // biru -> collaborator
                        '#22c55e', // hijau -> reguler
                    ],
                ],
            ],

            'labels' => [
                'Admin',
                'Collaborator',
                'Reguler',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
        ];
    }

    protected function getMaxHeight(): string
    {
        return '250px';
    }
}
