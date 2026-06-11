<?php

namespace App\Filament\Resources\SiteContents;

use App\Filament\Resources\SiteContents\Pages\CreatePageContent;
use App\Filament\Resources\SiteContents\Pages\EditPageContent;
use App\Filament\Resources\SiteContents\Pages\ListPageContents;
use App\Models\PageContent;
use App\Models\User;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class PageContentResource extends Resource
{
    protected static ?string $model = PageContent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentText;
    protected static ?string $recordTitleAttribute = 'content_key';
    protected static ?string $navigationLabel = 'Konten Halaman';
    protected static ?string $pluralModelLabel = 'Konten Halaman';
    protected static string|UnitEnum|null $navigationGroup = 'Konten Dinamis';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('page_id')
                ->label('Page')
                ->relationship('page', 'name')
                ->required()
                ->searchable()
                ->native(false),
            TextInput::make('content_key')
                ->label('Key Konten')
                ->required()
                ->maxLength(255),
            Select::make('content_type')
                ->label('Tipe Konten')
                ->options([
                    'text' => 'Text',
                    'textarea' => 'Textarea',
                    'richtext' => 'Rich Text',
                    'image' => 'Image',
                    'file' => 'File',
                    'url' => 'URL',
                    'json' => 'JSON',
                    'boolean' => 'Boolean',
                    'number' => 'Number',
                ])
                ->required()
                ->native(false),
            Textarea::make('content_value')
                ->label('Isi Konten')
                ->rows(6),
            TextInput::make('sort_order')
                ->label('Urutan')
                ->numeric()
                ->default(0),
            Toggle::make('is_active')
                ->label('Aktif')
                ->default(true),
            Hidden::make('user_id')
                ->default(fn () => Auth::id()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page.name')
                    ->label('Page')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('content_key')
                    ->label('Key')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('content_type')
                    ->label('Tipe')
                    ->badge()
                    ->sortable(),
                TextColumn::make('content_value')
                    ->label('Nilai')
                    ->limit(50),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Aktif' : 'Nonaktif')
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray'),
            ])
            ->defaultSort('page_id')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([]);
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();

        return $user instanceof User && $user->isAdmin();
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDeleteAny(): bool
    {
        return static::canViewAny();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPageContents::route('/'),
            'create' => CreatePageContent::route('/create'),
            'edit' => EditPageContent::route('/{record}/edit'),
        ];
    }
}
