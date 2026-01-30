<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Forms\Components;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('news_id')
                    ->relationship('news', 'title')
                    ->required(),
            ]);
    }
}
