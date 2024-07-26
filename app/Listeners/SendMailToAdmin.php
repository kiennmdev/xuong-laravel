<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailToAdmin
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
        Mail::send('mails/emailOrderToAdmin', [],function ($message) {
            $message->to('kiennmph41026@fpt.edu.vn', 'Tutorials Point')
            ->subject('Laravel Basic Testing Mail');
        });

    }
}
