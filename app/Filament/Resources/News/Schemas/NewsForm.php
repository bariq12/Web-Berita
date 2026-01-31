<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Forms\Components;
use Illuminate\Support\Str; 

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Forms\Components\Select::make('user_id')
                //     ->relationship('users', 'name')
                //     ->required(),
                Forms\Components\Select::make('news_category_id')
                    ->relationship('newsCategory', 'title')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ( $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->readOnly(),
                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->directory('news/thumbnails')
                    ->disk('public') // ← WAJIB
                    ->visibility('public') // ← WAJIB
                    ->required()
                    ->columnSpanFull()
                    ->required(),
                    Forms\Components\DatePicker::make('published_at')
                    ->required(),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Featured News')
                    ->default(false),
                ]);
    }
}
