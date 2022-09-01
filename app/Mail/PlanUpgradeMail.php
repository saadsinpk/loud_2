<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanUpgradeMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $name, $price;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('About Your Subscription')->view('emails.plan_upgraded');
    }

}
