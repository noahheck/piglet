<?php

namespace App\Calendar;

use Carbon\Carbon;

class MonthDetailProvider
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
     * @var Carbon
     */
    private $carbon;

    /**
     * MonthDetailProvider constructor.
     * @param $year
     * @param $month
     */
    public function __construct($year, $month)
    {
        $this->year  = $year;
        $this->month = $month;

        $this->carbon = Carbon::createFromDate($this->year, $this->month, '15');
    }

    /**
     * @return object
     */
    public function nextMonth()
    {
        $copy = $this->carbon->copy();

        $copy->addMonth();

        return (object) [
            'month' => $copy->month,
            'year'  => $copy->year,
        ];
    }

    /**
     * @return object
     */
    public function previousMonth()
    {
        $copy = $this->carbon->copy();

        $copy->subMonth();

        return (object) [
            'month' => $copy->month,
            'year'  => $copy->year,
        ];
    }

    /**
     * @return int
     */
    public function daysInMonth()
    {
        return $this->carbon->daysInMonth;
    }

    /**
     * @return int
     */
    public function emptyCellsAtBeginningOfMonth()
    {
        return $this->carbon->copy()->startOfMonth()->dayOfWeek;
    }

    /**
     * @return int
     */
    public function emptyCellsAtEndOfMonth()
    {
        return 6 - $this->carbon->copy()->endOfMonth()->dayOfWeek;
    }
}
