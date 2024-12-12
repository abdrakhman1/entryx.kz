<?php


namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderMail;

class EmailService
{
    public function sendOrderConfirmation($order)
    {
        // Mail::to(config('mail.recipient'))->send(new NewOrderMail($order, $order->user));
    }
}
