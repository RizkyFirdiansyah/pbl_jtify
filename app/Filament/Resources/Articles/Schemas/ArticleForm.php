<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Konten Utama')
                    ->icon('heroicon-o-document-text')
                    ->description('Isi artikel yang akan ditampilkan.')
                    ->schema([
                        Hidden::make('user_id')
                            ->default(fn () => Auth::id()),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),
                        Hidden::make('slug')
                            ->dehydrated(false),
                        MarkdownEditor::make('content')
                            ->label('Isi Artikel')
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

                Section::make('Media')
                    ->icon('heroicon-o-photo')
                    ->description('Gambar sampul artikel.')
                    ->schema([
                        FileUpload::make('poster_path')
                            ->label('Poster / Gambar Sampul')
                            ->image()
                            ->directory('articles/posters')
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
                            ->visible(function ($record) {
                                $user = Auth::user();

                                return ($user instanceof User && $user->isAdmin()) || filled($record?->revision_notes);
                            })
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}