<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Http\Controllers\Controller;

class MoneyMattersController extends Controller
{
    public function index(Family $family)
    {
        return view('family.money-matters', [
            'family' => $family,
        ]);
    }
}
