<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var App\Http\User
     */
    public $user;

    /**
     * @var integer
     */
    public $pin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $pin)
    {
        $this->user = $user;

        $this->pin  = $pin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.email-verification')
            ->text('email.text.email-verification');
    }
}
