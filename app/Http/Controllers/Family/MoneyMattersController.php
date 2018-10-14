<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MoneyMattersController extends Controller
{
    public function index(Family $family)
    {
        return view('family.money-matters', [
            'family' => $family,
        ]);
    }

    public function settingsView(Family $family)
    {
        return view('family.money-matters-settings', [
            'family' => $family,
        ]);
    }

    public function settingsSave(Request $request, Family $family)
    {
        $request->validate($family->settingsValidations());

        foreach ($request->only([
            Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT,
            Family::MONEY_MATTERS_RETIREMENT_AMOUNT,
            Family::MONEY_MATTERS_EDUCATION_AMOUNT,
            Family::MONEY_MATTERS_EMERGENCY_FUND_AMOUNT,
        ]) as $setting => $value) {
            $family->setSetting($setting, $value);
        }

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.money-matters.settings', [$family]);
    }
}
