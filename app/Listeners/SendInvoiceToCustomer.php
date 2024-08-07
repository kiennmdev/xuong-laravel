<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendInvoiceToCustomer
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
        $data = [
            'order' => $event->order->toArray(),
            'orderItems' => $event->orderItems
        ];

        Mail::send('mails/emailInvoice', $data,function ($message) use ($event) {
            $message->to($event->order->user_email, $event->order->user_name)
            ->subject('Hóa đơn từ cửa hàng Kenne');
        });

    }
}
