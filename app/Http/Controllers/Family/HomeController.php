<?php

namespace App\Http\Controllers\Family;

use App\Family;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Family $family)
    {
        return view('family.home', [
            'family'     => $family,
            'familyUser' => $family->familyUser(Auth::user()),
            'members'    => Family\Member::all(),
        ]);
    }

    /*
    public function ajaxTest(Request $request)
    {
        return response()->json([
            'success' => true,
            'errors'  => [],
            'data'    => [
                'test'      => 'Something true',
                'member'    => 1,
                'attribute' => 'name',
                'value'     => 'Noah',
            ]
        ]);
    }
    /**/
}
