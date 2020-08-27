<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = '';
    public $body = '';
    public $photoPath = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $body, $photoPath = '')
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->photoPath = $photoPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.notification')->subject($this->subject);
    }
}
