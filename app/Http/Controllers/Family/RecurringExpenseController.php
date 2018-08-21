<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\RecurringExpense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecurringExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family)
    {
        $recurringExpenses = RecurringExpense::orderBy('active', 'DESC')->orderBy('name')->get();

        return view('family.recurring-expenses.home', [
            'family'            => $family,
            'recurringExpenses' => $recurringExpenses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        $recurringExpense = new RecurringExpense();
        $recurringExpense->active = true;

        return view('family.recurring-expenses.new', [
            'family'           => $family,
            'recurringExpense' => $recurringExpense,
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
        $request->validate(RecurringExpense::getValidations());

        $recurringExpense = new RecurringExpense();

        $recurringExpense->fill($request->only($recurringExpense->getFillable()));

        $recurringExpense->active = $request->has('active');

        $recurringExpense->save();

        return redirect()->route('family.recurring-expenses.index', [$family]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\RecurringExpense  $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, RecurringExpense $recurringExpense)
    {
        return view('family.recurring-expenses.show', [
            'family'           => $family,
            'recurringExpense' => $recurringExpense,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\RecurringExpense  $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, RecurringExpense $recurringExpense)
    {
        return view('family.recurring-expenses.edit', [
            'family'           => $family,
            'recurringExpense' => $recurringExpense,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\RecurringExpense  $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, RecurringExpense $recurringExpense)
    {
        $request->validate($recurringExpense->getValidations());

        $recurringExpense->fill($request->only($recurringExpense->getFillable()));

        $recurringExpense->active = $request->has('active');

        $recurringExpense->save();

        return redirect()->route('family.recurring-expenses.index', [$family]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\RecurringExpense  $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family, RecurringExpense $recurringExpense)
    {
        //
    }
}
