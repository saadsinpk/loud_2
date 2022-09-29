<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductBoardOwnerMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $name,
            $email,
            $product;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $product) {
        $this->name = $name;
        $this->email = $email;
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('A item in your store has been requested ')->view('emails.product_board_owner');
    }

}
