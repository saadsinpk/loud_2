<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $name,
            $invitee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $invitee) {
        $this->name = $name;
        $this->invitee = $invitee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('Invitation to join TiedCircles')->view('emails.invitation');
    }

}
