<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateInventory
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        // dd($event->orderItems);

        foreach ($event->orderItems as $id => $item) {

            $productVariant = ProductVariant::query()->where('id', $id)->first();
            
            $productVariant->update([
                'quantity' => $productVariant->quantity - $item['quantity_purchase']
            ]);
            
        }

    }
}
