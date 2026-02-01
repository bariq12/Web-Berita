<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components;
use Filament\Actions;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('author.username')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                   

                Tables\Columns\TextColumn::make('newsCategory.title')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->circular(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Published At')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Featured')
                    ->sortable()
                    ->visible(fn () => auth()->user()->isAdmin()),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('author')->relationship('author', 'username') -> label('Author'),
                Tables\Filters\SelectFilter::make('newsCategory')->relationship('newsCategory', 'title') -> label('Category'),
            ])
            ->recordActions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
