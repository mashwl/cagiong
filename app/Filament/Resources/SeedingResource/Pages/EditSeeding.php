<?php

namespace App\Filament\Resources\SeedingResource\Pages;

use App\Filament\Resources\SeedingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeeding extends EditRecord
{
    protected static string $resource = SeedingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}
