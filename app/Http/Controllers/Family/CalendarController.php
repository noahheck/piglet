<?php

namespace App\Http\Controllers\Family;

use App\Calendar\DayDetailProvider;
use App\Calendar\MonthDetailProvider;
use App\Family;
use App\Family\CalendarEntryProvider;
use App\Http\Controllers\Controller;
use App\Http\Response\AjaxResponse;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function month(Request $request, Family $family, $year = null, $month = null, $day = null)
    {
        $today = \Auth::user()->today();

        if (!$year || !$month) {
            $year  = $today->year;
            $month = $today->month;
        }

        if (!$day) {
            $day = $today->day;
        }

        $monthDetailProvider = new MonthDetailProvider($year, $month);

        $monthEntryProvider = new CalendarEntryProvider($year, $month);

        $dayDetailProvider   = new DayDetailProvider($year, $month, $day);

        $dayEntryProvider = new CalendarEntryProvider($year, $month, $day);



        if ($request->expectsJson()) {

            $returnRoute = ($request->has('return')) ? $request->get('return') : null;

            $response = (new AjaxResponse(true))->set('content', view('family.calendar._day-detail', [
                'family'              => $family,
                'today'               => $today,
                'year'                => $year,
                'month'               => $month,
                'day'                 => $day,
                'monthDetailProvider' => $monthDetailProvider,
                'monthEntryProvider'  => $monthEntryProvider,
                'dayDetailProvider'   => $dayDetailProvider,
                'dayEntryProvider'    => $dayEntryProvider,
                'returnRoute'         => $returnRoute,
            ])->render());

            return response()->json($response);
        }

        return view('family.calendar.month', [
            'family'              => $family,
            'today'               => $today,
            'year'                => $year,
            'month'               => $month,
            'day'                 => $day,
            'monthDetailProvider' => $monthDetailProvider,
            'monthEntryProvider'  => $monthEntryProvider,
            'dayDetailProvider'   => $dayDetailProvider,
            'dayEntryProvider'    => $dayEntryProvider,
        ]);
    }

    /*public function day(Family $family, $year, $month, $day)
    {
        $dayDetailProvider = new DayDetailProvider($year, $month, $day);

        $dayEntryProvider = new CalendarEntryProvider($year, $month, $day);

        return view('family.calendar.day', [
            'family'            => $family,
            'year'              => $year,
            'month'             => $month,
            'day'               => $day,
            'dayDetailProvider' => $dayDetailProvider,
            'dayEntryProvider'  => $dayEntryProvider,
        ]);
    }*/
}
