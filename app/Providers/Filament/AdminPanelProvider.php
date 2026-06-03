<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Widgets\TotalWorkshopStat;
use App\Filament\Widgets\TotalLombaStat;
use App\Filament\Widgets\TotalBeasiswaStat;
use App\Filament\Widgets\InformationByCategoryChart;
use App\Filament\Widgets\TopRecruitmentsByInterestWidget;
use App\Filament\Widgets\TopTreeLomba;
use App\Filament\Widgets\TopTreeWorkshop;
use App\Filament\Widgets\TopTreeBeasiswa;
use App\Filament\Widgets\CategoriesInformationBarChart;
use App\Filament\Widgets\TotalUser;
use App\Filament\Widgets\RecentActivityWidget;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->authGuard('admin')
            ->id('admin')
            ->path('admin')
            ->login()
            ->globalSearch(false)
            ->font('poppins')
            ->brandName('JTIFY Admin')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->navigationGroups([
                'Konten JTI',
                'Manajemen Akses',
                'Sistem',
            ])
            ->widgets([
                TotalWorkshopStat::class,
                TotalLombaStat::class,
                TotalBeasiswaStat::class,
                TotalUser::class,
                TopTreeWorkshop::class,
                TopTreeLomba::class,
                TopTreeBeasiswa::class,
                RecentActivityWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
