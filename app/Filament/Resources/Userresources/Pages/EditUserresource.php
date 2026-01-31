<?php

namespace App\Filament\Resources\Userresources\Pages;

use App\Filament\Resources\Userresources\UserresourceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUserresource extends EditRecord
{
    protected static string $resource = UserresourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
