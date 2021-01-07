<?php

namespace App\Http\Controllers\Family;

use App\Calendar\DayDetailProvider;
use App\Family;
use App\Family\CalendarEntryProvider;
use App\Family\CashFlowPlan;
use App\Family\TodoProvider;
use App\Http\Response\AjaxResponse;
use App\Mail\MailgunTest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Family $family, TodoProvider $todoProvider)
    {
        $today = \Auth::user()->today();

        $year  = $today->year;
        $month = $today->month;
        $day   = $today->day;

        $dayDetailProvider = new DayDetailProvider($year, $month, $day);
        $dayEntryProvider  = new CalendarEntryProvider($year, $month, $day);

        if ($currentCfp = CashFlowPlan::current($today)) {
            $currentCfp->load(['expenseGroups.expenses']);
        }

        $user = \Auth::user();
        $member = $user->familyMember();
        $today = $user->today();

        $todos = $todoProvider->getPendingTodosForMember($member);

        $completedTodos = $todoProvider->getTodosForMemberCompletedOnDate($member, $today);

        return view('family.home', [
            'family'     => $family,
            'members'    => Family\Member::all(),
            'currentCfp' => $currentCfp,

            'today' => $today,
            'year'  => $year,
            'month' => $month,
            'day'   => $day,
            'dayDetailProvider' => $dayDetailProvider,
            'dayEntryProvider'  => $dayEntryProvider,
            'returnRoute'       => route('family.home', $family),
            'todos' => $todos,
            'completedTodos' => $completedTodos,
        ]);
    }
}
