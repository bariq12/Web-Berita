<?php

namespace App\Filament\Resources\Userresources;

use App\Filament\Resources\Userresources\Pages\CreateUserresource;
use App\Filament\Resources\Userresources\Pages\EditUserresource;
use App\Filament\Resources\Userresources\Pages\ListUserresources;
use App\Filament\Resources\Userresources\Schemas\UserresourceForm;
use App\Filament\Resources\Userresources\Tables\UserresourcesTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserresourceResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;
      public static function  canViewAny(): bool
    {
        return auth()->user()->isAdmin() === true;
    }

    public static function canCreate(): bool
    {
        return auth()->user()->isAdmin() === true;
    }
    protected static ?string $recordTitleAttribute = 'Users';

    public static function form(Schema $schema): Schema
    {
        return UserresourceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserresourcesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUserresources::route('/'),
            'create' => CreateUserresource::route('/create'),
            'edit' => EditUserresource::route('/{record}/edit'),
        ];
    }
}
