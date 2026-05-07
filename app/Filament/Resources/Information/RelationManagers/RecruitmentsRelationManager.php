<?php

namespace App\Filament\Resources\Information\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class RecruitmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'recruitments';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('role_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slots_available')
                    ->numeric()
                    ->required()
                    ->default(1)
                    ->minValue(1),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('role_name'),
                TextEntry::make('slots_available'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('role_name')
            ->columns([
                TextColumn::make('role_name')
                    ->searchable(),
                TextColumn::make('slots_available')
                    ->label('Slots Tersedia'),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->recordActions([
                ViewAction::make(),
                EditAction::make()->visible(fn(): bool => Auth::user()?->isAdmin() ?? false),
                DeleteAction::make()->visible(fn(): bool => Auth::user()?->isAdmin() ?? false),
            ])
            ->toolbarActions([
                // 
            ]);
    }
}
