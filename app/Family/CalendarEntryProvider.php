<?php

namespace App\Family;

use App\Calendar\MonthDetailProvider;
use App\Family\Event;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CalendarEntryProvider
{
    /**
     * @var string
     */
    private $year;

    /**
     * @var string
     */
    private $month;

    /**
     * @var string|null
     */
    private $day;

    /**
     * @var array
     */
    private $entries = [];

    /**
     * @var array
     */
    private $events = [];

    /**
     * CalendarEntryProvider constructor.
     * @param $year
     * @param $month
     * @param null $day
     */
    public function __construct($year, $month, $day = null)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;

        $this->fetchEntries();
    }

    /**
     * @return array
     */
    public function entries()
    {
        return $this->entries;
    }

    public function hasEntryForDay($day)
    {
        $nonBirthdayEvents = $this->nonBirthdayEvents();

        $filterDate = Carbon::createFromDate($this->year, $this->month, $day)->format('m/d/Y');

        $nonBirthdayEventsForDay = $nonBirthdayEvents->where('date', $filterDate);

        return $nonBirthdayEventsForDay->count() !== 0;
    }

    public function hasBirthdayForDay($day)
    {
        $birthdayEvents = $this->birthdayEvents();

        $filterDate = Carbon::createFromDate($this->year, $this->month, $day)->format('m/d/Y');

        $birthdaysForDay = $birthdayEvents->where('date', $filterDate);

        return $birthdaysForDay->count() !== 0;
    }

    /**
     * @return array
     */
    public function events()
    {
        return $this->events;
    }

    private function fetchEntries()
    {

        if (!$this->day) {
            // Calendar scope is a month
            $monthDetails = new MonthDetailProvider($this->year, $this->month);

            $startOfMonth = Carbon::createFromDate($this->year, $this->month, '1')->format('m/d/Y');
            $endOfMonth   = Carbon::createFromdate($this->year, $this->month, $monthDetails->daysInMonth())->format('m/d/Y');

            $events = Event::whereBetween('date', [$startOfMonth, $endOfMonth])->orderBy('date')->get();

            $birthdayContacts = Member::whereMonth('birthdate', $monthDetails->monthWithLeadingZero())->orderBy('birthdate')->get();

            $birthdayEvents = $this->contactsToBirthdayEvents($birthdayContacts);
        } else {
            // Calendar scope is a day
            $carbon = Carbon::createFromDate($this->year, $this->month, $this->day);
            $date = $carbon->format('m/d/Y');

            $events = Event::where('date', $date)->orderBy('all_day', 'desc')->get();

            $birthdayContacts = Member::whereMonth('birthdate', $carbon->format('m'))
                                      ->whereDay('birthdate', $carbon->format('d'))
                                      ->get();

            $birthdayEvents = $this->contactsToBirthdayEvents($birthdayContacts);
        }

        $birthdayEvents->each(function($event, $key) use ($events) {
            $events->push($event);
        });

        $sortedEvents = $events->sort(function($a, $b) {

            $_a = Carbon::createFromFormat('m/d/Y g:i', $a->date . ' 00:00');
            $_b = Carbon::createFromFormat('m/d/Y g:i', $b->date . ' 00:00');

            if ($_a == $_b) {
                // Same date, so check if one is all day and other is not

                if ($a->isBirthday() || $b->isBirthday()) {
                    return $b->isBirthday() - $a->isBirthday();
                }

                if ($a->all_day || $b->all_day) {
                    // At least one is all day, so we can compare on that
                    // We want all day events first, so we'll inverse the comparison
                    return $b->all_day - $a->all_day;
                }
            }

            $aTime  = $a->date . ' ';
            $aTime .= ($a->time) ? $a->time : '00:00 AM';
            $bTime  = $b->date . ' ';
            $bTime .= ($b->time) ? $b->time : '00:00 AM';


            $_a = Carbon::createFromFormat('m/d/Y g:i A', $aTime);
            $_b = Carbon::createFromFormat('m/d/Y g:i A', $bTime);

            return $_a->timestamp <=> $_b->timestamp;
        });

        $this->events  = $sortedEvents;
        $this->entries = $sortedEvents;
    }

    private function contactsToBirthdayEvents($birthdayContacts)
    {
        $events = collect([]);

        $birthdayContacts->each(function($contact, $key) use ($events) {
            $bdayEvent = new BirthdayEvent($contact->toArray());

            $date = Carbon::createFromFormat('Y-m-d G:i:s', $bdayEvent->birthdate);
            $date->year($this->year);
            $bdayEvent->date = $date->format('m/d/Y');

            $events->push($bdayEvent);
        });

        return $events;
    }

    private function nonBirthdayEvents()
    {
        return $this->entries->filter(function($event) {
            return !$event->isBirthday();
        });
    }

    private function birthdayEvents()
    {
        return $this->entries->filter(function($event) {
            return $event->isBirthday();
        });
    }
}
