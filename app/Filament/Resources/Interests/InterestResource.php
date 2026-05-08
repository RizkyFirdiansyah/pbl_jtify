<?php

namespace App\Filament\Resources\Interests;

use App\Filament\Resources\Interests\Pages\CreateInterest;
use App\Filament\Resources\Interests\Pages\EditInterest;
use App\Filament\Resources\Interests\Pages\ListInterests;
use App\Filament\Resources\Interests\Schemas\InterestForm;
use App\Filament\Resources\Interests\Tables\InterestsTable;
use App\Models\Interest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Support\Facades\Auth;

class InterestResource extends Resource
{
    protected static ?string $model = Interest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Peminatan';
    protected static ?string $pluralModelLabel = 'Peminatan';
    protected static string|UnitEnum|null $navigationGroup = 'Konten JTI';

    public static function form(Schema $schema): Schema
    {
        return InterestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InterestsTable::configure($table);
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

    public static function getPages(): array
    {
        return [
            'index' => ListInterests::route('/'),
            'edit' => EditInterest::route('/{record}/edit'),
        ];
    }
}
