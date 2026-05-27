<?php

namespace App\Filament\Resources\Feedback;

use App\Filament\Resources\Feedback\Pages\EditFeedback;
use App\Filament\Resources\Feedback\Pages\ListFeedback;
use App\Filament\Resources\Feedback\Schemas\FeedbackForm;
use App\Filament\Resources\Feedback\Tables\FeedbackTable;
use App\Models\Feedback;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Support\Facades\Auth;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeftRight;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Feedback';
    protected static ?string $pluralModelLabel = 'Feedback';
    protected static string|UnitEnum|null $navigationGroup = 'Sistem';

    public static function form(Schema $schema): Schema
    {
        return FeedbackForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeedbackTable::configure($table);
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
        $user = Auth::user();
        return $user && $user->isAdmin();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFeedback::route('/'),
            'edit' => EditFeedback::route('/{record}/edit'),
        ];
    }
}
