<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductReservationMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $product,
            $qty;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product, $qty) {
        $this->product = $product;
        $this->qty = $qty;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('Product Reserved')->view('emails.product_reservation');
    }

}
