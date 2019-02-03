<?php

namespace Tests\Unit\Calendar;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Calendar\MonthDetailProvider;

class MonthDetailProviderTest extends TestCase
{
    public function testNextMonthReturnsNextMonthDetailsCorrectly()
    {
        $month = new MonthDetailProvider('2019', '02');

        $nextMonth = $month->nextMonth();

        $this->assertEquals('2019', $nextMonth->year);
        $this->assertEquals('03', $nextMonth->month);


        $december = new MonthDetailProvider('2019', '12');

        $nextMonth = $december->nextMonth();

        $this->assertEquals('2020', $nextMonth->year);
        $this->assertEquals('01', $nextMonth->month);
    }

    public function testNextMonthCalledMultipleTimesOnSameMonthDetailsProviderReturnsNextMonthCorrectly()
    {
        $month = new MonthDetailProvider('2019', '02');

        $nextMonth = $month->nextMonth();

        $this->assertEquals('2019', $nextMonth->year);
        $this->assertEquals('03', $nextMonth->month);

        $nextMonth = $month->nextMonth();

        $this->assertEquals('2019', $nextMonth->year);
        $this->assertEquals('03', $nextMonth->month);
    }



    public function testPreviousMonthReturnsPreviousMonthDetailsCorrectly()
    {
        $month = new MonthDetailProvider('2019', '02');

        $lastMonth = $month->previousMonth();

        $this->assertEquals('2019', $lastMonth->year);
        $this->assertEquals('01', $lastMonth->month);


        $january = new MonthDetailProvider('2019', '01');

        $lastMonth = $january->previousMonth();

        $this->assertEquals('2018', $lastMonth->year);
        $this->assertEquals('12', $lastMonth->month);
    }

    public function testPreviousMonthCalledMultipleTimesOnSameMonthDetailsProviderReturnsPreviousMonthCorrectly()
    {
        $month = new MonthDetailProvider('2019', '02');

        $lastMonth = $month->previousMonth();

        $this->assertEquals('2019', $lastMonth->year);
        $this->assertEquals('01', $lastMonth->month);

        $lastMonth = $month->previousMonth();

        $this->assertEquals('2019', $lastMonth->year);
        $this->assertEquals('01', $lastMonth->month);
    }



    public function testDaysInMonthReturnsCorrectNumberOfDaysInTheMonth()
    {
        $month = new MonthDetailProvider('2019', '02');
        $this->assertEquals(28, $month->daysInMonth());

        $month = new MonthDetailProvider('2019', '01');
        $this->assertEquals(31, $month->daysInMonth());

        $month = new MonthDetailProvider('2019', '04');
        $this->assertEquals(30, $month->daysInMonth());

        $leapMonth = new MonthDetailProvider('2020', '02');
        $this->assertEquals(29, $leapMonth->daysInMonth());
    }



    public function testEmptyCellsAtBeginningOfMonthReturnsCorrectNumber()
    {
        $month = new MonthDetailProvider('2019', '02');
        $this->assertEquals(5, $month->emptyCellsAtBeginningOfMonth());

        $month = new MonthDetailProvider('2019', '03');
        $this->assertEquals(5, $month->emptyCellsAtBeginningOfMonth());

        $month = new MonthDetailProvider('2019', '01');
        $this->assertEquals(2, $month->emptyCellsAtBeginningOfMonth());

        $month = new MonthDetailProvider('2019', '04');
        $this->assertEquals(1, $month->emptyCellsAtBeginningOfMonth());

        $month = new MonthDetailProvider('2019', '06');
        $this->assertEquals(6, $month->emptyCellsAtBeginningOfMonth());

        $month = new MonthDetailProvider('2019', '09');
        $this->assertEquals(0, $month->emptyCellsAtBeginningOfMonth());

        $month = new MonthDetailProvider('2019', '08');
        $this->assertEquals(4, $month->emptyCellsAtBeginningOfMonth());
    }



    public function testEmptyCellsAtEndOfMonthReturnsCorrectNumber()
    {
        $month = new MonthDetailProvider('2019', '02');
        $this->assertEquals(2, $month->emptyCellsAtEndOfMonth());

        $month = new MonthDetailProvider('2019', '03');
        $this->assertEquals(6, $month->emptyCellsAtEndOfMonth());

        $month = new MonthDetailProvider('2019', '01');
        $this->assertEquals(2, $month->emptyCellsAtEndOfMonth());

        $month = new MonthDetailProvider('2019', '04');
        $this->assertEquals(4, $month->emptyCellsAtEndOfMonth());

        $month = new MonthDetailProvider('2019', '06');
        $this->assertEquals(6, $month->emptyCellsAtEndOfMonth());

        $month = new MonthDetailProvider('2019', '09');
        $this->assertEquals(5, $month->emptyCellsAtEndOfMonth());

        $month = new MonthDetailProvider('2019', '08');
        $this->assertEquals(0, $month->emptyCellsAtEndOfMonth());
    }
}
