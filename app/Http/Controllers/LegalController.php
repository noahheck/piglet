<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function terms()
    {
        return view('legal.terms-of-use', []);
    }

    public function privacy()
    {
        return view('legal.privacy', []);
    }
}
