<?php

namespace App\Filament\Resources\Bookmarks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;

class BookmarksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Mahasiswa')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('information.title')
                    ->label('Informasi')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('information.category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('reminder_enabled')
                    ->label('Status Pengingat')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Active' : 'None')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Tertarik')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Filter berdasarkan kategori
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->relationship('information.category', 'name'),

                // Filter berdasarkan informasi
                SelectFilter::make('information_id')
                    ->label('Informasi')
                    ->relationship('information', 'title'),

                // Filter berdasarkan status
                SelectFilter::make('reminder_enabled')
                    ->label('Status Pengingat')
                    ->options([
                        'active' => 'Active',
                        'none' => 'None',
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['value'] === 'active') {
                            $query->where('reminder_enabled', true);
                        } elseif ($data['value'] === 'none') {
                            $query->where('reminder_enabled', false);
                        }
                    }),
            ])
            ->recordActions([
                // ViewAction::make(),
                // EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                // DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
