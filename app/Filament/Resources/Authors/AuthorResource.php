<?php

namespace App\Filament\Resources\Authors;

use App\Filament\Resources\Authors\Pages\CreateAuthor;
use App\Filament\Resources\Authors\Pages\EditAuthor;
use App\Filament\Resources\Authors\Pages\ListAuthors;
use App\Filament\Resources\Authors\Schemas\AuthorForm;
use App\Filament\Resources\Authors\Tables\AuthorsTable;
use App\Models\Author;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components;


class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    public static function  canViewAny(): bool
    {
        return auth()->user()->isAdmin() === true;
    }

    public static function canCreate(): bool
    {
        return auth()->user()->isAdmin() === true;
    }

    protected static ?string $recordTitleAttribute = 'Author';

    public static function form(Schema $schema): Schema
    {
          return $schema
        ->schema([
            Components\Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name')
                ->required()
                ->searchable()
                ->preload(),               
            Components\TextInput::make('username')
                ->required()
                ->maxLength(255),

            Components\FileUpload::make('avatar')
                ->image()
                ->required()
                ->disk('public')              // pakai disk public
                ->directory('news/authors') ,

            Components\RichEditor::make('bio')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->circular(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('username')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('bio')
                    ->label('Bio')
                    ->searchable()
                    ->sortable(),

            ])
        ->filters([
            //
        ])
        ->recordActions([
           Actions\EditAction::make(),
           Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Actions\BulkAction::make('delete')
            ->icon('heroicon-o-trash')
            ->color('danger')
            ->requiresConfirmation()
            ->action(fn (Collection $records) => $records->each->delete()),
        ]);
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
            'index' => ListAuthors::route('/'),
            'create' => CreateAuthor::route('/create'),
            'edit' => EditAuthor::route('/{record}/edit'),
        ];
    }
}
