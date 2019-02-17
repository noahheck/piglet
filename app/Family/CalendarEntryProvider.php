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
        } else {
            // Calendar scope is a day
            $date = Carbon::createFromDate($this->year, $this->month, $this->day)->format('m/d/Y');

            $events = Event::where('date', $date)->orderBy('all_day', 'desc')->get();
        }

        $sortedEvents = $events->sort(function($a, $b) {

            $_a = Carbon::createFromFormat('m/d/Y g:i', $a->date . ' 00:00');
            $_b = Carbon::createFromFormat('m/d/Y g:i', $b->date . ' 00:00');

            if ($_a == $_b) {
                // Same date, so check if one is all day and other is not

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
}
