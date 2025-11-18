<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // \Filament\Actions\Action::make('reset_all')
            //     ->label('Xóa')
            //     ->color('danger')
            //     ->icon('heroicon-o-trash')
            //     ->requiresConfirmation()
            //     ->action(function () {
            //         \App\Models\Order::truncate();  
            //     })
        ];
    }
    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}
