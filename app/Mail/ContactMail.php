<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name = '';
    public $surname = '';
    public $email = '';
    public $subject = '';
    public $msg = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $surname, $email, $msg, $subject = 'Nová správa z kontaktného formulára')
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->msg = $msg;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.contact')->replyTo($this->email)->subject($this->subject);
    }
}
