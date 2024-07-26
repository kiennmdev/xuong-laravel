<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\OrderLog;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveOrderLog
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
        $order = $event->order->toArray();

        $orderLog = $order + [
            'date_time' => Carbon::now()->toDayDateTimeString(),
            'status' => 'create'
        ];
        OrderLog::query()->create($orderLog);
    }
}
