<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventReservationToOwnerMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $event,
            $name,
            $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $name, $email) {
        $this->event = $event;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('New Event Reservation')->view('emails.event_reservation_to_owner');
    }

}
