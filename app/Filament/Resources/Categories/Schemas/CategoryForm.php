<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Kategori')
                    ->required()
                    ->minLength(3)
                    ->maxLength(100)
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn (callable $set, $state) => $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->required()
                    ->minLength(3)
                    ->maxLength(100)
                    ->unique(table: 'categories', column: 'slug', ignorable: fn ($record) => $record)
                    ->helperText('Slug otomatis terisi dari nama, bisa diubah manual.'),
            ]);
    }
}