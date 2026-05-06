<?php

namespace App\Filament\Resources\Information\Schemas;

use App\Models\User;
use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Facades\Auth;

class InformationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Konten Utama')
                    ->icon('heroicon-o-document-text')
                    ->description('Informasi utama yang akan ditampilkan pada halaman detail.')
                    ->schema([
                        Hidden::make('user_id')
                            ->default(fn() => Auth::id()),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),
                        Hidden::make('slug')
                            ->dehydrated(false),
                        MarkdownEditor::make('description')
                            ->required(),
                        Select::make('status')
                            ->options(function () {
                                $user = Auth::user();

                                if ($user instanceof User && $user->isAdmin()) {
                                    return [
                                        'draft' => 'Draft',
                                        'pending_review' => 'Pending Review',
                                        'published' => 'Published',
                                        'archived' => 'Archived',
                                    ];
                                }

                                return [
                                    'draft' => 'Draft',
                                    'pending_review' => 'Pending Review',
                                ];
                            })
                            ->default('draft')
                            ->required(),
                    ])->columnSpanFull(),

                Section::make('Detail & Media')
                    ->icon('heroicon-o-information-circle')
                    ->description('Detail tambahan dan media pendukung untuk informasi ini.')
                    ->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->native(false),
                        DatePicker::make('deadline')
                            ->required()
                            ->native(false),
                        TextInput::make('registration_link')
                            ->url(),
                        TextInput::make('guidebook_link')
                            ->url()
                            ->label('Link Panduan')
                            ->placeholder('Opsional: URL panduan/petunjuk peserta'),
                        FileUpload::make('poster_path')
                            ->image()
                            ->directory('posters')
                            ->imageEditor(),
                    ])->columnSpanFull(),

                Section::make('Review Super Admin')
                    ->icon('heroicon-o-shield-check')
                    ->description('Kolom persetujuan dan catatan revisi dari super admin.')
                    ->schema([
                        TextInput::make('approved_at')
                            ->label('Tanggal Persetujuan')
                            ->disabled()
                            ->dehydrated(false)
                            ->visible(function () {
                                $user = Auth::user();

                                return $user instanceof User && $user->isAdmin();
                            }),
                        Textarea::make('revision_notes')
                            ->label('Catatan Revisi')
                            ->rows(4)
                            ->disabled(function () {
                                $user = Auth::user();

                                return ! ($user instanceof User && $user->isAdmin());
                            })
                            ->dehydrated(function () {
                                $user = Auth::user();

                                return $user instanceof User && $user->isAdmin();
                            })
                            ->visible(function () {
                                $user = Auth::user();

                                return ($user instanceof User && $user->isAdmin()) || filled(request('record'));
                            })
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
