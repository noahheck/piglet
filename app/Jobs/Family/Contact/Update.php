<?php

namespace App\Jobs\Family\Contact;

use App\Family\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $contact;
    private $first_name;
    private $middle_name;
    private $last_name;
    private $birthdate;
    private $phone;
    private $secondaryPhone;
    private $address1;
    private $address2;
    private $city;
    private $state;
    private $zip;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        Contact $contact,
        $first_name,
        $middle_name,
        $last_name,
        $birthdate,
        $phone,
        $secondaryPhone,
        $address1,
        $address2,
        $city,
        $state,
        $zip
    ) {
        $this->contact = $contact;
        $this->first_name = $first_name;
        $this->middle_name = $middle_name;
        $this->last_name = $last_name;
        $this->birthdate = $birthdate;
        $this->phone = $phone;
        $this->secondaryPhone = $secondaryPhone;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $contact = $this->contact;

        $contact->first_name = $this->first_name;
        $contact->middle_name = $this->middle_name;
        $contact->last_name = $this->last_name;
        $contact->birthdate = $this->birthdate;
        $contact->phone = $this->phone;
        $contact->secondaryPhone = $this->secondaryPhone;
        $contact->address1 = $this->address1;
        $contact->address2 = $this->address2;
        $contact->city = $this->city;
        $contact->state = $this->state;
        $contact->zip = $this->zip;

        $contact->save();
    }
}
