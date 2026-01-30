<?php

namespace App\Filament\Resources\NewsCategories;

use App\Filament\Resources\NewsCategories\Pages\CreateNewsCategory;
use App\Filament\Resources\NewsCategories\Pages\EditNewsCategory;
use App\Filament\Resources\NewsCategories\Pages\ListNewsCategories;
use App\Filament\Resources\NewsCategories\Schemas\NewsCategoryForm;
use App\Filament\Resources\NewsCategories\Tables\NewsCategoriesTable;
use App\Models\NewsCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components;
use Illuminate\Support\Str;
use Filament\Tables;
use Filament\Actions;
class NewsCategoryResource extends Resource
{
    protected static ?string $model = NewsCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ListBullet;

    protected static ?string $recordTitleAttribute = 'News Category';

    public static function form(Schema $schema): Schema
    {
        return  $schema
        ->schema([
            Components\TextInput::make('title')
             ->live(onBlur: true)
             ->afterStateUpdated(fn ( $set, ?string $state) => $set('slug', Str::slug($state)))
            ->required()
            ->maxLength(255),

            Components\TextInput::make('slug')
            ->readOnly()
        ]);
    }

    public static function table(Table $table): Table
    {
         return $table
            ->columns([
              
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),

               

            ])
        ->filters([
            //
        ])
        ->recordActions([
            Actions\ViewAction::make(),
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
            'index' => ListNewsCategories::route('/'),
            'create' => CreateNewsCategory::route('/create'),
            'edit' => EditNewsCategory::route('/{record}/edit'),
        ];
    }
}
