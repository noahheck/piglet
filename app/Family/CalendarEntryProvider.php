<?php

namespace App\Family;

use App\Family\Event;

class CalendarEntryProvider
{


    public function __construct()
    {

    }

    public function entriesFor($year, $month, $day = null)
    {
        $entries = Event::all();

        return $entries;
    }
}
