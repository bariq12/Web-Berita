<?php

namespace App\Filament\Resources\Userresources\Pages;

use App\Filament\Resources\Userresources\UserresourceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserresource extends CreateRecord
{
    protected static string $resource = UserresourceResource::class;
}
