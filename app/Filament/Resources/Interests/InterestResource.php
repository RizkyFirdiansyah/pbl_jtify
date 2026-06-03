<?php

namespace App\Filament\Resources\Interests;

use App\Filament\Resources\Interests\Pages\ListInterests;
use App\Filament\Resources\Interests\Pages\ViewInterest;
use App\Filament\Resources\Interests\Schemas\InterestInfolist;
use App\Filament\Resources\Interests\Tables\InterestsTable;
use App\Models\Interest;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class InterestResource extends Resource
{
  protected static ?string $model = Interest::class;

  protected static string|BackedEnum|null $navigationIcon = Heroicon::Sparkles;
  protected static ?string $recordTitleAttribute = 'id';
  protected static ?string $navigationLabel = 'Daftar Peminat';
  protected static ?string $pluralModelLabel = 'Daftar Peminat';
  protected static string|UnitEnum|null $navigationGroup = 'Konten JTI';
  protected static ?int $navigationSort = 4;

  public static function infolist(Schema $schema): Schema
  {
    return InterestInfolist::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return InterestsTable::configure($table);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function canViewAny(): bool
  {
    $user = Auth::user();

    return $user instanceof User && $user->isAdmin();
  }

  public static function canCreate(): bool
  {
    return false;
  }

  public static function canEdit(Model $record): bool
  {
    return false;
  }

  public static function canDelete(Model $record): bool
  {
    return false;
  }

  public static function canDeleteAny(): bool
  {
    return false;
  }

  public static function getPages(): array
  {
    return [
      'index' => ListInterests::route('/'),
      'view' => ViewInterest::route('/{record}'),
    ];
  }
}
