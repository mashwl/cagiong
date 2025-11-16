<?php

namespace App\Filament\Resources\SanphamphuResource\Pages;

use App\Filament\Resources\SanphamphuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Firefly\FilamentBlog\Resources\SeoDetailResource;

class CreateSanphamphu extends CreateRecord
{
    protected static string $resource = SanphamphuResource::class;
    protected function getRedirectUrl(): string
    {
        return SeoDetailResource::getUrl('create', ['sanphamphu_id' => $this->record->id]);
    }
}
