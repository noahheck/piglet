<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\CashFlowPlan;
use App\Family\RecurringExpense;
use App\Family\IncomeSource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashFlowPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family)
    {
        $cashFlowPlans = CashFlowPlan::all();

        $curYear  = date('Y');
        $nextYear = $curYear + 1;

        $minExisting = $cashFlowPlans->min('year');

        $minYear = ($minExisting && $curYear > $minExisting) ? $minExisting : $curYear;

        $years = array_merge(range($minYear, $nextYear), [$curYear]);

        $years = array_unique(array_reverse($years));

        return view('family.cash-flow-plans.home', [
            'family'        => $family,
            'cashFlowPlans' => $cashFlowPlans,
            'years'         => $years,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        // This one shouldn't ever be hit; if it is, we'll just ignore it
    }

    public function createPlan(Request $request, Family $family, $year, $month)
    {
        $existingPlan = CashFlowPlan::where(['year' => $year, 'month' => $month])->get();

        \DebugBar::info($existingPlan);

        if ($existingPlan->count()) {
            $request->session()->flash('error', "The cash flow plan for {$year}-{$month} has already been created");
            return redirect()->route('family.cash-flow-plans.index', [$family]);
        }

        // Get current set of income sources to show to the user
        $incomeSources = IncomeSource::where('active', true)->orderBy('name')->get();

        // Get current set of recurring expenses to show to the user
        $recurringExpenses = RecurringExpense::orderBy('active', 'DESC')->orderBy('name')->get();

        return view('family.cash-flow-plans.new', [
            'family' => $family,
            'year'   => $year,
            'month'  => $month,
            'incomeSources'     => $incomeSources,
            'recurringExpenses' => $recurringExpenses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Family $family)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\CashFlowPlan $cashFlowPlan
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, CashFlowPlan $cashFlowPlan)
    {
        return view('family.cash-flow-plans.show', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\CashFlowPlan $cashFlowPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, CashFlowPlan $cashFlowPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\CashFlowPlan $cashFlowPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, CashFlowPlan $cashFlowPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\CashFlowPlan $cashFlowPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashFlowPlan $cashFlowPlan)
    {
        //
    }
}
