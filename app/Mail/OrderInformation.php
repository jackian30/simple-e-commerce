<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Checkout;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class OrderInformation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Checkout $checkout, public $checkoutProduct, public User $user)
    {
        // 
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Successful' . $this->user->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.orderInformation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
