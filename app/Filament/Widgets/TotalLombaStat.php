<?php

namespace App\Filament\Widgets;

use App\Models\Information;
use Filament\Widgets\Widget;

class TotalLombaStat extends Widget
{
    protected string $view = 'filament.widgets.stat-tall-widget';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 3;

    public string $label       = 'Total Lomba';
    public string $description = 'Informasi lomba tersedia';
    public string $color       = '#10b981';
    public string $icon        = 'heroicon-o-trophy';
    
    

    public function getValue(): int
    {
        return Information::where('category_id', 2)->count();
    }
}
