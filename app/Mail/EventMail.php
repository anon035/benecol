<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventMail extends Mailable
{
    use Queueable, SerializesModels;

    public $eventName = '';
    public $eventLink = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($eventName, $eventLink)
    {
        $this->eventName = $eventName;
        $this->eventLink = $eventLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.event-notification')->subject('Máte novú pozvánku');
    }
}
