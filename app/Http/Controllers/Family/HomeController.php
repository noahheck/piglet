<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Http\Response\AjaxResponse;
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
        $response = new AjaxResponse();

        $response->success(true)->set('test', 'Something')->set('member', 1)->addError("Something went wrong");

        return response()->json($response);

        /*return response()->json([
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
