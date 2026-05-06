<?php

namespace App\Filament\Resources\Collaborators\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;

class CollaboratorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Detail Pengajuan')
                    ->icon('heroicon-o-user-group')
                    ->description('Informasi tentang pengajuan collaborator submission.')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->disabled(), // User tidak boleh diubah manual
                        Textarea::make('reason')
                            ->label('Alasan Pengajuan')
                            ->required()
                            ->disabled()
                            ->columnSpanFull(),
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                            ])
                            ->required(),
                        Select::make('reviewed_by')
                            ->relationship('reviewer', 'name')
                            ->searchable()
                            ->preload(),
                    ])->columnSpanFull()
            ]);
    }
}
