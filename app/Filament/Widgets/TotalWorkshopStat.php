<?php

namespace App\Filament\Widgets;

use App\Models\Information;
use Filament\Widgets\Widget;

class TotalWorkshopStat extends Widget
{
    protected string $view = 'filament.widgets.stat-tall-widget';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 3;

    public string $label       = 'Total Workshop';
    public string $description = 'Informasi workshop tersedia';
    public string $color       = '#3b82f6';
    public string $icon        = 'heroicon-o-academic-cap';

    public function getValue(): int
    {
        return Information::where('category_id', 1)->count();
    }
}
