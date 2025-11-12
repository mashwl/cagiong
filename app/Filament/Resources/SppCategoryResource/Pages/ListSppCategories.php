<?php

namespace App\Filament\Resources\SppCategoryResource\Pages;

use App\Filament\Resources\SppCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSppCategories extends ListRecords
{
    protected static string $resource = SppCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
