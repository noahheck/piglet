<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\Category;
use App\Family\CashFlowPlan;
use App\Family\ExpenseGroup;
use App\Family\PiggyBank;
use App\Family\RecurringExpense;
use App\Family\IncomeSource;
use App\Http\Controllers\Controller;
use App\Interfaces\Definitions\Settings;
use Illuminate\Http\Request;

use function App\flashSuccess;
use function App\flashError;

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

        $curYear  = \Auth::user()->today()->format('Y');
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
            flashError('cash-flow-plans.already-created', ['year' => $year, 'month' => $month]);

            return redirect()->route('family.cash-flow-plans.index', [$family]);
        }

        $lifestyleExpenses = [
            'pocket-money' => $family->getSetting(Settings::MONEY_MATTERS_POCKET_MONEY_AMOUNT),
            'retirement'   => $family->getSetting(Settings::MONEY_MATTERS_RETIREMENT_AMOUNT),
            'education'    => $family->getSetting(Settings::MONEY_MATTERS_EDUCATION_AMOUNT),
        ];

        // Get list of categories to organize expenses
        $categories = Category::orderBy('active', 'DESC')->orderBy('d_order')->get();

        // Get current set of income sources to show to the user
        $incomeSources = IncomeSource::where('active', true)->orderBy('name')->get();

        // Get current set of active piggy banks to show to the user
        $piggyBanks = PiggyBank::where([
            ['active', '=', true],
            ['completed', '=', false],
        ])->orderBy('dueDate')->get();

        // Get current set of recurring expenses to show to the user
        $recurringExpenses = RecurringExpense::where('active', true)->orderBy('active', 'DESC')->orderBy('name')->get();

        // Get current set of expense groups to show to the user
        $expenseGroups = ExpenseGroup::where('active', true)->orderBy('name')->get();

        return view('family.cash-flow-plans.new', [
            'family' => $family,
            'year'   => $year,
            'month'  => $month,
            'categories'        => $categories,
            'incomeSources'     => $incomeSources,
            'lifestyleExpenses' => $lifestyleExpenses,
            'piggyBanks'        => $piggyBanks,
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
            flashError('cash-flow-plans.already-created', ['year' => $year, 'month' => $month]);

            return redirect()->route('family.cash-flow-plans.index', [$family]);
        }

        $lifestyleExpenses = [
            'pocket-money' => $family->getSetting(Settings::MONEY_MATTERS_POCKET_MONEY_AMOUNT),
            'retirement'   => $family->getSetting(Settings::MONEY_MATTERS_RETIREMENT_AMOUNT),
            'education'    => $family->getSetting(Settings::MONEY_MATTERS_EDUCATION_AMOUNT),
        ];

        // Get current set of income sources to add to the plan
        $incomeSources = IncomeSource::where('active', true)->orderBy('name')->get();

        // Get current set of active piggy banks to show to the user
        $piggyBanks = PiggyBank::where([
            ['active', '=', true],
            ['completed', '=', false],
        ])->orderBy('dueDate')->get();

        // Get current set of recurring expenses to add to the plan
        $recurringExpenses = RecurringExpense::where('active', true)->orderBy('active', 'DESC')->orderBy('name')->get();

        // Get current set of expense groups to add to the plan
        $expenseGroups = ExpenseGroup::where('active', true)->orderBy('name')->get();

        $cashFlowPlan = CashFlowPlan::createNew(
            $year,
            $month,
            $lifestyleExpenses,
            $incomeSources,
            $piggyBanks,
            $recurringExpenses,
            $expenseGroups
        );

        if (!$cashFlowPlan) {
            flashError('cash-flow-plans.cant-create', ['year' => $year, 'month' => $month]);

            return redirect()->route('family.cash-flow-plans.index', [$family]);
        }

        flashSuccess('cash-flow-plans.cash-flow-plan-created');

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

        $recurringExpenses = $cashFlowPlan->recurringExpenses()->orderBy('date')->get();

        $cashFlowPlan->expenseGroups->load(['expenses', 'category']);

        $cashFlowPlan->load(['incomeSources', 'recurringExpenses', 'piggyBanks', 'expenses']);

        $cashFlowPlan->piggyBanks->load(['piggyBank', 'contributions']);

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



    public function lifestyleExpensesView(Family $family, CashFlowPlan $cashFlowPlan)
    {
        return view('family.cash-flow-plans.lifestyle-expenses', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
        ]);
    }

    public function lifestyleExpensesSave(Request $request, Family $family, CashFlowPlan $cashFlowPlan)
    {
        $request->validate($cashFlowPlan->lifestyleExpensesValidations());

        foreach ($request->only(['pocket_money', 'retirement', 'education']) as $expense => $value) {
            $cashFlowPlan->$expense = $value;
        }

        $cashFlowPlan->pocket_money_distributed = $request->has('pocket_money_distributed');
        $cashFlowPlan->retirement_distributed   = $request->has('retirement_distributed');
        $cashFlowPlan->education_distributed    = $request->has('education_distributed');

        $cashFlowPlan->save();

        flashSuccess('cash-flow-plans.lifestyle-expenses-updated');

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.cash-flow-plans.show', [$family, $cashFlowPlan]);
    }
}
