<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\User
     */
    public $user;

    /**
     * @var \App\Family\Member
     */
    public $member;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $member)
    {
        $this->user       = $user;
        $this->member     = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.invitation')
            ->text('email.text.invitation');
    }
}
