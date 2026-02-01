<?php

namespace App\Filament\Resources\Userresources\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components;
use Filament\Actions;



class UserresourcesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->colors([
                        'admin' => 'danger',
                        'author' => 'primary',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.username')
                    ->label('username')
                    ->sortable(),   
                Tables\Columns\TextColumn::make('created_at')
                    ->label('dibuat pada')
                    ->dateTime('d-M-Y H:i')
                    ->sortable(),   
                // Tables\Columns\ToggleColumn::make('email_verified')
                //     //  ->label('Email Verified')
                //     // ->sortable()
                //     // ->getStateUsing(fn ($state) => ! is_null($state))
                //     // ->updateStateUsing(function ($record, bool $state) {
                //     //     $record->update([
                //     //         'email_verified_at' => $state ? now() : null,
                //     //     ]);
                //     // }),

            ])
            ->filters([
                //
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
