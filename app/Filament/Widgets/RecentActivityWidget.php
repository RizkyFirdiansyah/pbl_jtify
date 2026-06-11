<?php

namespace App\Filament\Widgets;

use App\Models\Collaborator;
use App\Models\Information;
use App\Models\Interest;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class RecentActivityWidget extends Widget
{
    protected string $view = 'filament.widgets.recent-activity-widget';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 8;

    public function getActivities(): Collection
    {
        $activities = collect();

        // Pendaftaran minat (interest) oleh user
        $interests = Interest::with(['user', 'information.category'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($interest) {
                $categoryId   = $interest->information?->category_id;
                $categoryName = $interest->information?->category?->name ?? 'Informasi';
                $infoTitle    = $interest->information?->title ?? '-';

                $badgeColor = match ($categoryId) {
                    1 => '#3b82f6', 
                    2 => '#10b981', 
                    3 => '#f59e0b', 
                    default => '#6b7280',
                };

                return [
                    'userName'   => $interest->user?->name ?? 'User',
                    'userRole'   => $interest->user?->role ?? 'reguler',
                    'activity'   => "Mendaftar {$categoryName} \"{$infoTitle}\"",
                    'badge'      => $categoryName,
                    'badgeColor' => $badgeColor,
                    'icon'       => '👤',
                    'time'       => $interest->created_at,
                ];
            });

        // Informasi baru ditambahkan oleh kolaborator/admin
        $informations = Information::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($info) {
                $categoryId   = $info->category_id;
                $categoryName = $info->category?->name ?? 'Informasi';

                $badgeColor = match ($categoryId) {
                    1 => '#3b82f6', 
                    2 => '#10b981', 
                    3 => '#f59e0b', 
                    default => '#6b7280',
                };

                return [
                    'userName'   => $info->user?->name ?? 'Admin',
                    'userRole'   => $info->user?->role ?? 'admin',
                    'activity'   => "Menambahkan info {$categoryName} \"{$info->title}\"",
                    'badge'      => 'Informasi Baru',
                    'badgeColor' => $badgeColor,
                    'icon'       => '📄',
                    'time'       => $info->created_at,
                ];
            });

        // Pendaftaran kolaborator baru
        $collaborators = Collaborator::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($collab) {
                $activityText = match ($collab->status) {
                    'approved' => 'Disetujui sebagai Kolaborator',
                    'rejected' => 'Ditolak sebagai Kolaborator',
                    default    => 'Mendaftar sebagai Kolaborator',
                };

                $badgeColor = match ($collab->status) {
                    'approved' => '#10b981',
                    'rejected' => '#ef4444',
                    default    => '#f59e0b',
                };

                return [
                    'userName'   => $collab->user?->name ?? 'User',
                    'userRole'   => $collab->user?->role ?? 'reguler',
                    'activity'   => $activityText,
                    'badge'      => 'Kolaborator',
                    'badgeColor' => $badgeColor,
                    'icon'       => '🪪',
                    'time'       => $collab->created_at,
                ];
            });

        return $activities
            ->merge($interests)
            ->merge($informations)
            ->merge($collaborators)
            ->sortByDesc('time')
            ->take(5)
            ->values();
    }
}
