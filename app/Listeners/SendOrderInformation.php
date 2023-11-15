<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Mail\OrderInformation;
use App\Models\CheckoutProduct;
use App\Events\CheckoutSucessful;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class SendOrderInformation implements ShouldQueue, ShouldHandleEventsAfterCommit
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle(CheckoutSucessful $event): void
    {
        $checkout = $event->checkout;

        $checkoutProduct = CheckoutProduct::where('checkout_id', $checkout->id)->with('product')->get();

        $user = User::where('id', $checkout->user_id)->first();

        Mail::to($user->email)->send(new OrderInformation($checkout, $checkoutProduct, $user));
    }
}
