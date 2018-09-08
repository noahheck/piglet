<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\Category;
use App\Family\CashFlowPlan;
use App\Family\ExpenseGroup;
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

        if ($existingPlan->count()) {
            $request->session()->flash('error', "The cash flow plan for {$year}-{$month} has already been created");
            return redirect()->route('family.cash-flow-plans.index', [$family]);
        }

        // Get list of categories to organize expenses
        $categories = Category::orderBy('active', 'DESC')->orderBy('d_order')->get();

        // Get current set of income sources to show to the user
        $incomeSources = IncomeSource::where('active', true)->orderBy('name')->get();

        // Get current set of recurring expenses to show to the user
        $recurringExpenses = RecurringExpense::orderBy('active', 'DESC')->orderBy('name')->get();

        // Get current set of expense groups to show to the user
        $expenseGroups = ExpenseGroup::where('active', true)->orderBy('name')->get();

        return view('family.cash-flow-plans.new', [
            'family' => $family,
            'year'   => $year,
            'month'  => $month,
            'categories'        => $categories,
            'incomeSources'     => $incomeSources,
            'recurringExpenses' => $recurringExpenses,
            'expenseGroups'     => $expenseGroups,
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
        // This one shouldn't ever be hit; if it is, we'll just ignore it
    }

    public function storePlan(Request $request, Family $family, $year, $month)
    {
        $existingPlan = CashFlowPlan::where(['year' => $year, 'month' => $month])->get();

        if ($existingPlan->count()) {
            $request->session()->flash('error', "The cash flow plan for {$year}-{$month} has already been created");
            return redirect()->route('family.cash-flow-plans.index', [$family]);
        }

        // Get current set of income sources to add to the plan
        $incomeSources = IncomeSource::where('active', true)->orderBy('name')->get();

        // Get current set of recurring expenses to add to the plan
        $recurringExpenses = RecurringExpense::orderBy('active', 'DESC')->orderBy('name')->get();

        // Get current set of expense groups to add to the plan
        $expenseGroups = ExpenseGroup::where('active', true)->orderBy('name')->get();

        $cashFlowPlan = CashFlowPlan::createNew($year, $month, $incomeSources, $recurringExpenses, $expenseGroups);

        if (!$cashFlowPlan) {
            $request->session()->flash('error', "Unable to create the cash flow plan for {$year}-{$month}");
            return redirect()->route('family.cash-flow-plans.index', [$family]);
        }

        return redirect()->route('family.cash-flow-plans.show', [$family, $cashFlowPlan]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\CashFlowPlan $cashFlowPlan
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, CashFlowPlan $cashFlowPlan)
    {
        $categories = Category::orderBy('active', 'DESC')->orderBy('d_order')->get();

        $recurringExpenses = $cashFlowPlan->recurringExpenses()->orderBy('name')->get();

        $cashFlowPlan->expenseGroups->load('expenses');

        return view('family.cash-flow-plans.show', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'categories'   => $categories,
            'recurringExpenses' => $recurringExpenses,
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
