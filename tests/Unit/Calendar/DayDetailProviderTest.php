<?php

namespace Tests\Unit\Calendar;

use App\Calendar\DayDetailProvider;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DayDetailProviderTest extends TestCase
{
    public function testNextDayReturnsNextDayDetailsCorrectly()
    {
        $day = new DayDetailProvider('2019', '02', '03');

        $nextDay = $day->nextDay();

        $this->assertEquals('2019', $nextDay->year);
        $this->assertEquals('02', $nextDay->month);
        $this->assertEquals('04', $nextDay->day);


        $endOfMonth = new DayDetailProvider('2019', '02', '28');

        $beginningOfMonth = $endOfMonth->nextDay();

        $this->assertEquals('2019', $beginningOfMonth->year);
        $this->assertEquals('03', $beginningOfMonth->month);
        $this->assertEquals('01', $beginningOfMonth->day);


        $endOfYear = new DayDetailProvider('2019', '12', '31');

        $beginningOfYear = $endOfYear->nextDay();

        $this->assertEquals('2020', $beginningOfYear->year);
        $this->assertEquals('01', $beginningOfYear->month);
        $this->assertEquals('01', $beginningOfYear->day);
    }



    public function testPreviousDayReturnsPreviousDayDetailsCorrectly()
    {
        $day = new DayDetailProvider('2019', '02', '03');

        $previousDay = $day->previousDay();

        $this->assertEquals('2019', $previousDay->year);
        $this->assertEquals('02', $previousDay->month);
        $this->assertEquals('02', $previousDay->day);


        $beginningOfMonth = new DayDetailProvider('2019', '02', '01');

        $endOfMonth = $beginningOfMonth->previousDay();

        $this->assertEquals('2019', $endOfMonth->year);
        $this->assertEquals('01', $endOfMonth->month);
        $this->assertEquals('31', $endOfMonth->day);


        $beginningOfYear = new DayDetailProvider('2019', '01', '01');

        $endOfYear = $beginningOfYear->previousDay();

        $this->assertEquals('2018', $endOfYear->year);
        $this->assertEquals('12', $endOfYear->month);
        $this->assertEquals('31', $endOfYear->day);
    }



    public function testDayOfWeekReturnsCorrectDayOfWeek()
    {
        $day = new DayDetailProvider('2019', '02', '03');
        $this->assertEquals(0, $day->dayOfWeek());

        $day = new DayDetailProvider('2019', '02', '04');
        $this->assertEquals(1, $day->dayOfWeek());

        $day = new DayDetailProvider('2019', '02', '14');
        $this->assertEquals(4, $day->dayOfWeek());

        $day = new DayDetailProvider('2019', '07', '15');
        $this->assertEquals(1, $day->dayOfWeek());

        $day = new DayDetailProvider('2019', '12', '25');
        $this->assertEquals(3, $day->dayOfWeek());

        $day = new DayDetailProvider('2029', '11', '16');
        $this->assertEquals(5, $day->dayOfWeek());
    }
}
