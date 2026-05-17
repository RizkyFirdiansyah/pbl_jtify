<?php

namespace App\Filament\Resources\Interests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;


class InterestsTable
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
                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'cancelled' => 'Cancelled',
                    ])
                    ->sortable()
                    ->searchable(),
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
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}