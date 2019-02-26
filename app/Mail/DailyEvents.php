<?php

namespace App\Mail;

use App\Family;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

class DailyEvents extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var array
     */
    public $familyEntryDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $familyEntryDetails)
    {
        $this->user               = $user;
        $this->familyEntryDetails = $familyEntryDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Good Morning')
            ->view('email.daily-events')
            ->text('email.text.daily-events');
    }
}
