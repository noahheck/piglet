<?php

namespace App\Http\Controllers\Family;

use App\Family;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Family $family)
    {
        return view('family.home', [
            'family' => $family,
        ]);
    }
}
