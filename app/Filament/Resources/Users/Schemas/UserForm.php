<?php

namespace App\Filament\Resources\Users\Schemas;


use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Schemas\Components\Section as section;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                section::make('Informasi Personal')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(table: 'users', column: 'email', ignorable: fn ($record) => $record),

                        TextInput::make('password')
                            ->password()
                            ->required(fn ($operation) => $operation === 'create') // wajib hanya saat create
                            ->minLength(6)
                            ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : null)
                            ->dehydrated(fn ($state) => !empty($state)) 
                            ->label('Password')
                            ->helperText('Minimal 6 karakter. Kosongkan jika tidak ingin mengubah password saat edit.'),

                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(20),

                        Select::make('role')
                            ->options([
                                'admin' => 'Admin',
                                'collaborator' => 'Collaborator',
                                'reguler' => 'Reguler',
                            ])
                            ->default('Reguler')
                            ->required(),
                    ])
                    ->columnSpan('full'),

                section::make('Dokumen Profesional')
                    ->schema([
                        FileUpload::make('cv_path')
                            ->label('CV')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->directory('cvs')
                            ->preserveFilenames() //mempertahankan nama file asli
                            ->maxSize(5120)
                            ->previewable()
                            ->downloadable()
                            ->openable(),

                        TextInput::make('linkedin_url')
                            ->label('LinkedIn URL')
                            ->url()
                            ->maxLength(255)
                            ->Copyable(),
                    ])
                    ->columnSpan('full'),
            ]);
    }
}