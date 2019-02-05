<?php

namespace App\Http\Controllers\Family;

use App\Calendar\MonthDetailProvider;
use App\Family;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function show(Family $family, $year = null, $month = null)
    {
        $today = \Auth::user()->today();

        if (!$year || !$month) {
            $year  = $today->year;
            $month = $today->month;
        }

        $monthDetailProvider = new MonthDetailProvider($year, $month);

        return view('family.calendar.home', [
            'family'              => $family,
            'today'               => $today,
            'year'                => $year,
            'month'               => $month,
            'monthDetailProvider' => $monthDetailProvider,
        ]);
    }
}
