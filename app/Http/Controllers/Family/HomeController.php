<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\CashFlowPlan;
use App\Http\Response\AjaxResponse;
use App\Mail\MailgunTest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Family $family)
    {
        $currentCfp = CashFlowPlan::current(Auth::user()->today());

        return view('family.home', [
            'family'     => $family,
            'familyUser' => $family->familyUser(Auth::user()),
            'members'    => Family\Member::all(),
            'currentCfp' => $currentCfp,
        ]);
    }
}
