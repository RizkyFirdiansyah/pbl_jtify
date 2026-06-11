<?php

namespace App\Filament\Resources\Likes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LikeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('Nama Mahasiswa'),
                TextEntry::make('information.title')
                    ->label('Informasi'),
                TextEntry::make('information.category.name')
                    ->label('Kategori'),
                TextEntry::make('status')
                    ->label('Status'),
                TextEntry::make('consented_at')
                    ->label('Disetujui Pada')
                    ->dateTime('d M Y H:i'),
                TextEntry::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i'),
            ]);
    }
}
