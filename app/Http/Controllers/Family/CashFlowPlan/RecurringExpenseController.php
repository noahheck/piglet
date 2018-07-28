<?php

namespace App\Http\Controllers\Family\CashFlowPlan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Family;
use App\Family\CashFlowPlan;
use App\Family\CashFlowPlan\RecurringExpense;

class RecurringExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family, CashFlowPlan $cashFlowPlan)
    {
        return view('family.cash-flow-plans.recurring-expenses.home', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family, CashFlowPlan $cashFlowPlan)
    {
        $recurringExpense = new RecurringExpense();

        return view('family.cash-flow-plans.recurring-expenses.new', [
            'family'           => $family,
            'cashFlowPlan'     => $cashFlowPlan,
            'recurringExpense' => $recurringExpense,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Family $family, CashFlowPlan $cashFlowPlan)
    {
        $request->validate(RecurringExpense::getValidations());

        $recurringExpense = new RecurringExpense();

        $recurringExpense->cash_flow_plan_id = $cashFlowPlan->id;

        $recurringExpense->fill($request->only($recurringExpense->getFillable()));

        $recurringExpense->save();

        return redirect()->route('family.cash-flow-plans.recurring-expenses.index', [$family, $cashFlowPlan, '#' . $recurringExpense->type]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\RecurringExpense  $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, CashFlowPlan $cashFlowPlan, RecurringExpense $recurringExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\RecurringExpense  $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, CashFlowPlan $cashFlowPlan, RecurringExpense $recurringExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\CashFlowPlan\RecurringExpense  $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, CashFlowPlan $cashFlowPlan, RecurringExpense $recurringExpense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\CashFlowPlan\RecurringExpense  $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family, CashFlowPlan $cashFlowPlan, RecurringExpense $recurringExpense)
    {
        //
    }
}
