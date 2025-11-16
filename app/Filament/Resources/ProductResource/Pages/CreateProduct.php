<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Firefly\FilamentBlog\Resources\SeoDetailResource;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    protected function getRedirectUrl(): string
    {
        return SeoDetailResource::getUrl('create', ['product_id' => $this->record->id]);
    }
}
