<?php

namespace App\Filament\Resources\Likes;

use App\Filament\Resources\Likes\Pages\CreateLike;
use App\Filament\Resources\Likes\Pages\EditLike;
use App\Filament\Resources\Likes\Pages\ListLikes;
use App\Filament\Resources\Likes\Pages\ViewLike;
use App\Filament\Resources\Likes\Schemas\LikeForm;
use App\Filament\Resources\Likes\Schemas\LikeInfolist;
use App\Filament\Resources\Likes\Tables\LikesTable;
use App\Models\Like;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LikeResource extends Resource
{
    protected static ?string $model = Like::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Heart;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Daftar Disukai';
    protected static ?string $pluralModelLabel = 'Daftar Disukai';
    protected static string|UnitEnum|null $navigationGroup = 'Konten JTI';

    public static function form(Schema $schema): Schema
    {
        return LikeForm::configure($schema);
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

    public static function getPages(): array
    {
        return [
            'index' => ListLikes::route('/'),
            'create' => CreateLike::route('/create'),
            'view' => ViewLike::route('/{record}'),
            'edit' => EditLike::route('/{record}/edit'),
        ];
    }
}
