<?php

namespace App\Http\Controllers\Family;

use App\Calendar\DayDetailProvider;
use App\Calendar\MonthDetailProvider;
use App\Family;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function month(Family $family, $year = null, $month = null)
    {
        $today = \Auth::user()->today();

        if (!$year || !$month) {
            $year  = $today->year;
            $month = $today->month;
        }

        $monthDetailProvider = new MonthDetailProvider($year, $month);

        return view('family.calendar.month', [
            'family'              => $family,
            'today'               => $today,
            'year'                => $year,
            'month'               => $month,
            'monthDetailProvider' => $monthDetailProvider,
        ]);
    }

    public function day(Family $family, $year, $month, $day)
    {
        $dayDetailProvider = new DayDetailProvider($year, $month, $day);

        return view('family.calendar.day', [
            'family'            => $family,
            'year'              => $year,
            'month'             => $month,
            'day'               => $day,
            'dayDetailProvider' => $dayDetailProvider,
        ]);
    }
}
