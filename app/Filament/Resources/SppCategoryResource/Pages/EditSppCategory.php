<?php

namespace App\Filament\Resources\SppCategoryResource\Pages;

use App\Filament\Resources\SppCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSppCategory extends EditRecord
{
    protected static string $resource = SppCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
