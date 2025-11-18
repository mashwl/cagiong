<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Tất Cả'),
            'order' => Tab::make('Đơn Đặt Hàng')
                ->modifyQueryUsing(function ($query) {
                    $query->where('type', 'order');
                }),
            'quote' => Tab::make('Yêu Cầu Báo Giá')
                ->modifyQueryUsing(function ($query) {
                    $query->where('type', 'quote');
                })

        ];
    }
    
}
