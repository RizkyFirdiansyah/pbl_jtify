<?php

namespace App\Filament\Resources\Likes;

use App\Filament\Resources\Likes\Pages\ListLikes;
use App\Filament\Resources\Likes\Pages\ViewLike;
use App\Filament\Resources\Likes\Schemas\LikeInfolist;
use App\Filament\Resources\Likes\Tables\LikesTable;
use App\Models\Like;
use App\Models\User;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class LikeResource extends Resource
{
    protected static ?string $model = Like::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Heart;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Daftar Disukai';
    protected static ?string $pluralModelLabel = 'Daftar Disukai';
    protected static string|UnitEnum|null $navigationGroup = 'Konten JTI';
    protected static ?int $navigationSort = 6;

    public static function infolist(Schema $schema): Schema
    {
        return LikeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LikesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canViewAny(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();

        return $user instanceof User && $user->isAdmin();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLikes::route('/'),
            'view' => ViewLike::route('/{record}'),
        ];
    }
}
