<?php

namespace App\Filament\Resources\Notifications;

use App\Filament\Resources\Notifications\Pages\ListNotifications;
use App\Filament\Resources\Notifications\Schemas\NotificationForm;
use App\Filament\Resources\Notifications\Tables\NotificationsTable;
use App\Models\Notification;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Support\Facades\Auth;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BellAlert;

    protected static ?string $recordTitleAttribute = 'nama';
    protected static ?string $navigationLabel = 'Log Notifikasi';
    protected static ?string $pluralModelLabel = 'Log Notifikasi';
    protected static string|UnitEnum|null $navigationGroup = 'Sistem';

    public static function form(Schema $schema): Schema
    {
        return NotificationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NotificationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();
        return $user && $user->isAdmin();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNotifications::route('/'),
        ];
    }
}
