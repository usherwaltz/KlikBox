<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $id;
    /**
     * Create a new message instance.
     *
     * @param Order  $order order data
     * @param string $id    Order Id
     *
     * @return void
     */
    public function __construct(Order $order, $id)
    {
        $this->order = $order;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orderMail')
            ->subject("Nova narudzba");
    }
}
