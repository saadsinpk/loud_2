<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductReservationToOwnerMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $product,
            $qty,
            $name,
            $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product, $qty, $name, $email) {
        $this->product = $product;
        $this->qty = $qty;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('Product Reserved')->view('emails.product_reservation_to_owner');
    }

}
