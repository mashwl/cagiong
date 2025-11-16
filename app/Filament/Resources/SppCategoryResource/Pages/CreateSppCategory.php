<?php

namespace App\Filament\Resources\SppCategoryResource\Pages;

use App\Filament\Resources\SppCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSppCategory extends CreateRecord
{
    protected static string $resource = SppCategoryResource::class;
    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}
