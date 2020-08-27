<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $registration_number;
    public $password;
    public $reset;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $registration_number, $password, $reset = false)
    {
        $this->name = $name;
        $this->registration_number = $registration_number;
        $this->password = $password;
        $this->reset = $reset;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->reset) {
            return $this->view('mail.reset')->subject('Vaše heslo resetované | FA BENECOL Košice');
        } else {
            return $this->view('mail.welcome')->subject('Vitajte vo FA BENECOL Košice');
        }
    }
}
