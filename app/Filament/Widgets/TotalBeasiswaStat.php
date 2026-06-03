<?php

namespace App\Filament\Widgets;

use App\Models\Information;
use Filament\Widgets\Widget;

class TotalBeasiswaStat extends Widget
{
    protected string $view = 'filament.widgets.stat-tall-widget';
   

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 3;

    public string $label       = 'Total Beasiswa';
    public string $description = 'Informasi beasiswa tersedia';
    public string $color       = '#f59e0b';
    public string $icon        = 'heroicon-o-book-open';

    public function getValue(): int
    {
        return Information::where('category_id', 3)->count();
    }
}
