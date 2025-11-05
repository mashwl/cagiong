<?php

namespace App\Filament\Resources\SeedingResource\Pages;

use App\Filament\Resources\SeedingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSeedings extends ListRecords
{
    protected static string $resource = SeedingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
