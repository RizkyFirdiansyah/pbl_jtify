<?php

namespace App\Filament\Resources\Information;

use App\Filament\Resources\Information\Pages\CreateInformation;
use App\Filament\Resources\Information\Pages\EditInformation;
use App\Filament\Resources\Information\Pages\ListInformation;
use App\Filament\Resources\Information\Pages\ViewInformation;
use App\Filament\Resources\Information\Schemas\InformationForm;
use App\Filament\Resources\Information\Tables\InformationTable;
use App\Models\Information;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InformationResource extends Resource
{
    protected static ?string $model = Information::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentText;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Informasi';
    protected static ?string $pluralModelLabel = 'Informasi';
    protected static string|UnitEnum|null $navigationGroup = 'Konten JTI';

    public static function form(Schema $schema): Schema
    {
        return InformationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InformationTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInformation::route('/'),
            'create' => CreateInformation::route('/create'),
            'view' => ViewInformation::route('/{record}'),
            'edit' => EditInformation::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();

        return $user instanceof User && ($user->isAdmin() || $user->isCollaborator());
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit(Model $record): bool
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            return false;
        }

        if ($user->isAdmin()) {
            return true;
        }

        return $user->isCollaborator() && (int) $record->getAttribute('user_id') === (int) $user->id;
    }

    public static function canDelete(Model $record): bool
    {
        return static::canEdit($record);
    }

    public static function canDeleteAny(): bool
    {
        $user = Auth::user();

        return $user instanceof User && $user->isAdmin();
    }
}
