<?php

namespace App\Observers;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {   $user = User::all();
        Notification::make()
            ->title('Bạn vừa có đơn hàng mới!')
            ->body(
            "Đơn hàng của: {$order->name}\n" .
            "Sản phẩm: {$order->product_name}\n" .
            "Số lượng: {$order->quantity}\n" .
            "Mã đơn hàng: #{$order->id}"
)
            ->success()
            ->actions([
                Action::make('Xem đơn hàng')
                    ->url(OrderResource::getUrl('edit', ['record' => $order])),
            ])
            ->sendToDatabase($user);
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Oder "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
