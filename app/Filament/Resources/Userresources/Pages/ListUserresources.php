<?php

namespace App\Filament\Resources\Userresources\Pages;

use App\Filament\Resources\Userresources\UserresourceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserresources extends ListRecords
{
    protected static string $resource = UserresourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
