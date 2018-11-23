<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function home(Request $request)
    {
        return view('marketing.home', [

        ]);
    }

    public function project(Request $request)
    {
        return view('marketing.project', [

        ]);
    }

    public function pricing(Request $request)
    {
        return view('marketing.pricing', [

        ]);
    }
}
