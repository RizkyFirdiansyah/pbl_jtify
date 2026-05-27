<?php

namespace App\Filament\Resources\Feedback\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class FeedbackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('user.name')
                    ->label('Pengirim'),
                Textarea::make('message')
                    ->label('Pesan')
                    ->rows(5)
                    ->disabled(),
                Select::make('status')
                    ->label('Status')
                    ->disabled()
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Arsip',
                    ])
                    ->required(),
            ]);
    }
}
