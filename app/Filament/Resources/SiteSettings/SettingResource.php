<?php

namespace App\Filament\Resources\SiteSettings;

use App\Filament\Resources\SiteSettings\Pages\CreateSetting;
use App\Filament\Resources\SiteSettings\Pages\EditSetting;
use App\Filament\Resources\SiteSettings\Pages\ListSettings;
use App\Models\Setting;
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

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;
    protected static ?string $recordTitleAttribute = 'key_name';
    protected static ?string $navigationLabel = 'Pengaturan Website';
    protected static ?string $pluralModelLabel = 'Pengaturan Website';
    protected static string|UnitEnum|null $navigationGroup = 'Konten Dinamis';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('key_name')
                ->label('Key')
                ->required()
                ->maxLength(255),
            Select::make('data_type')
                ->label('Tipe Data')
                ->options([
                    'text' => 'Text',
                    'textarea' => 'Textarea',
                    'image' => 'Image',
                    'file' => 'File',
                    'url' => 'URL',
                    'json' => 'JSON',
                    'boolean' => 'Boolean',
                    'number' => 'Number',
                ])
                ->required()
                ->default('text')
                ->native(false),
            Textarea::make('value')
                ->label('Nilai')
                ->rows(6),
            Textarea::make('description')
                ->label('Deskripsi')
                ->rows(4),
            Hidden::make('user_id')
                ->default(fn () => Auth::id()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key_name')
                    ->label('Key')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('data_type')
                    ->label('Tipe')
                    ->badge()
                    ->sortable(),
                TextColumn::make('value')
                    ->label('Nilai')
                    ->limit(50),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('key_name')
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
            'index' => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'edit' => EditSetting::route('/{record}/edit'),
        ];
    }
}
