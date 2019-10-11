<?php

namespace App\Http\Controllers;

use App\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $activeFamilies = $user->families->where('active', true);
        $inactiveFamilies = $user->families->where('active', false);

        $invitations = Invitation
            ::where('email', '=', $user->email)
            ->whereNull('accepted_date')
            ->get()
        ;

        if ($invitations->count() === 0 && $activeFamilies->count() === 1) {

            return redirect()->route('family.home', [$activeFamilies->first()]);
        }

        return view('home', [
            'activeFamilies'   => $activeFamilies,
            'inactiveFamilies' => $inactiveFamilies,
            'invitations'      => $invitations,
        ]);
    }

    public function families(Request $request)
    {
        $families = $request->user()->families->sortBy('name');

        return view('all-families', [
            'families' => $families,
        ]);
    }

    /**
     * Logs the user out without needing to POST a form
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}
