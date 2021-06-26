<?php

namespace App\Http\Controllers\Family;

use App\Calendar\DayDetailProvider;
use App\Calendar\MonthDetailProvider;
use App\Family;
use App\Family\CalendarEntryProvider;
use App\Http\Controllers\Controller;
use App\Http\Response\AjaxResponse;
use App\Mail\DailyEvents;
use App\Service\FamilyConnectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        $monthEntryProvider = new CalendarEntryProvider($year, $month, null, $family->id);

        $dayDetailProvider   = new DayDetailProvider($year, $month, $day);

        $dayEntryProvider = new CalendarEntryProvider($year, $month, $day, $family->id);



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
}
