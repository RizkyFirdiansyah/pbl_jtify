<?php

namespace App\Filament\Resources\Notifications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class NotificationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Penerima')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('information.title')
                    ->label('Informasi Terkait')
                    ->sortable()
                    ->searchable()
                    ->limit(40),
                TextColumn::make('title')
                    ->label('Judul Notifikasi')
                    ->searchable(),
                IconColumn::make('is_read')
                    ->label('Dibaca')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
