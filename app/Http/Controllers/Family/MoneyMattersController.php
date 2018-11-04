<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\CashFlowPlan;
use App\Family\Category;
use App\Family\MoneyMattersCharts;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MoneyMattersController extends Controller
{
    public function index(Request $request, Family $family)
    {
        $year = ($request->query->has('year')) ? $request->query->get('year') : date('Y');

        $cashFlowPlans = CashFlowPlan::where('year', $year)->get();
        $cashFlowPlans->load(['recurringExpenses', 'expenses', 'incomeSources']);

        $categories = Category::where('active', true)->orderBy('d_order')->get();

        $chartDataProvider = new MoneyMattersCharts($cashFlowPlans, $categories);

        $yearOptions = CashFlowPlan::select('year')->get()->pluck('year')->unique();

        return view('family.money-matters', [
            'family'            => $family,
            'cashFlowPlans'     => $cashFlowPlans,
            'chartDataProvider' => $chartDataProvider,
            'yearOptions'       => $yearOptions,
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
