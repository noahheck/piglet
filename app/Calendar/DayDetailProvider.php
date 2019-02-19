<?php

namespace App\Calendar;

use Carbon\Carbon;

class DayDetailProvider
{
    /**
     * @var int
     */
    private $year;

    /**
     * @var int
     */
    private $month;

    /**
     * @var int
     */
    private $day;

    /**
     * @var Carbon
     */
    private $carbon;

    /**
     * DayDetailProvider constructor.
     * @param $year
     * @param $month
     * @param $day
     */
    public function __construct($year, $month, $day)
    {
        $this->year  = $year;
        $this->month = $month;
        $this->day   = $day;

        $this->carbon = Carbon::createFromDate($this->year, $this->month, $this->day);
    }

    /**
     * @return object
     */
    public function nextDay()
    {
        $copy = $this->carbon->copy();

        $copy->addDay();

        return (object) [
            'day'   => $copy->day,
            'month' => $copy->month,
            'year'  => $copy->year,
        ];
    }

    /**
     * @return object
     */
    public function previousDay()
    {
        $copy = $this->carbon->copy();

        $copy->subDay();

        return (object) [
            'day'   => $copy->day,
            'month' => $copy->month,
            'year'  => $copy->year,
        ];
    }

    /**
     * @return int
     */
    public function dayOfWeek()
    {
        return $this->carbon->copy()->dayOfWeek;
    }
}
