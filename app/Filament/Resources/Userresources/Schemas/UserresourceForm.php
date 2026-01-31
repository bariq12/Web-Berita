<?php

namespace App\Filament\Resources\Userresources\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Forms\Components;

class UserresourceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('role')
                        ->options([
                            'admin' => 'Admin',
                            'author' => 'Author',
                        ])
                        ->required()
                        ->default('author'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn(string $context) => $context === 'create')
                    ->minLength(8)
                    ->dehydrated(fn($state) => !empty($state)) 
                    ->dehydrateStateUsing(fn($state) => bcrypt($state))
                    ->maxLength(255),
                Forms\Components\Toggle::make('email_verified')
                    ->label('Email Verified')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle')
                    ->default(false),
            ]);
    }
}
