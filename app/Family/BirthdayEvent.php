<?php


namespace App\Family;


class BirthdayEvent
{
    public $member_id;
    public $first_name;
    public $last_name;
    public $birthdate;

    public $date;

    public $time = '00:00 AM';

    public function __construct($details)
    {
        $this->member_id  = $details['id'];
        $this->first_name = $details['firstName'];
        $this->last_name  = $details['lastName'];
        $this->birthdate  = $details['birthdate'];
    }

    public function isBirthday()
    {
        return true;
    }
}
