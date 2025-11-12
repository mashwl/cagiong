<?php

namespace App\Filament\Resources\SanphamphuResource\Pages;

use App\Filament\Resources\SanphamphuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSanphamphu extends EditRecord
{
    protected static string $resource = SanphamphuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
