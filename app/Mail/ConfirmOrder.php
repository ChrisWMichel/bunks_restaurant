<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmOrder extends Mailable
{
    use Queueable, SerializesModels;

   public $order;
   public $order_history;

    public function __construct($order, $order_history)
    {
        $this->order = $order;
        $this->order_history = $order_history;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.confirm-order')->subject('Order Confirmation');
    }
}
