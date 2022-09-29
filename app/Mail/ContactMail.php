<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $name,
            $email,
            $subject,
            $query;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $subject, $query) {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->query = $query;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('Someone has requested contact')->view('emails.contact');
    }

}
