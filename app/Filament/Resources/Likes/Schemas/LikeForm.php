<?php

namespace App\Filament\Resources\Likes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class LikeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Nama Mahasiswa')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->disabledOn('edit'),
                Select::make('information_id')
                    ->label('Informasi')
                    ->relationship('information', 'title')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->disabledOn('edit'),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required()
                    ->default('active'),
            ]);
    }
}
