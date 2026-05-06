<?php

namespace App\Filament\Resources\Notifications\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NotificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Penerima')
                    ->relationship('user', 'name'),
                Select::make('information_id')
                    ->label('Informasi Terkait')
                    ->relationship('information', 'title'),
                TextInput::make('title')
                    ->label('Judul Notifikasi')
                    ->columnSpanFull(),
                Textarea::make('message')
                    ->label('Pesan')
                    ->columnSpanFull(),
                Toggle::make('is_read')
                    ->label('Sudah Dibaca?'),
            ]);
    }
}
