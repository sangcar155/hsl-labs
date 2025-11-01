<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmationEmail
{
    public function handle(OrderPlaced $event)
    {
        $order = $event->order;

        // Make sure we mail to provider user email
        Mail::to($order->provider->user->email)
            ->send(new OrderConfirmationMail($order));
    }
}
