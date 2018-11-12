<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\CashFlowPlan;
use App\Family\Category;
use App\Family\MoneyMattersCharts;
use App\Http\Controllers\Controller;

use App\Interfaces\Definitions\Settings;
use Illuminate\Http\Request;

class MoneyMattersWelcomeController extends Controller
{
    public function index(Request $request, Family $family)
    {
        if ($family->getSetting(Settings::MONEY_MATTERS_FIRST_RUN_WIZARD_COMPLETE)) {
            // return redirect()->route('family.money-matters', [$family]);
        }

        return view('family.money-matters-welcome', [
            'family' => $family,
        ]);
    }

    public function assemble(Request $request, Family $family)
    {
        $family->setSetting(Family::MONEY_MATTERS_FIRST_RUN_WIZARD_COMPLETE, true);
        /*$request->validate($family->settingsValidations());

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

        return redirect()->route('family.money-matters.settings', [$family]);*/
    }
}