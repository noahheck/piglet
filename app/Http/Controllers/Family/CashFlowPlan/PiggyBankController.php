<?php

namespace App\Http\Controllers\Family\CashFlowPlan;

use App\Family;
use App\Family\CashFlowPlan;
use App\Family\CashFlowPlan\PiggyBank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PiggyBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Family $family
     * @param CashFlowPlan $cashFlowPlan
     */
    public function index(Family $family, CashFlowPlan $cashFlowPlan)
    {
        $piggyBanks = $cashFlowPlan->piggyBanks()->orderBy('dueDate')->get();

        return view('family.cash-flow-plans.piggy-banks.home', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'piggyBanks'   => $piggyBanks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family, CashFlowPlan $cashFlowPlan)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Family $family, CashFlowPlan $cashFlowPlan)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\PiggyBank  $piggyBank
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, CashFlowPlan $cashFlowPlan, PiggyBank $piggyBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\PiggyBank  $piggyBank
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, CashFlowPlan $cashFlowPlan, PiggyBank $piggyBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\CashFlowPlan\PiggyBank  $piggyBank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, CashFlowPlan $cashFlowPlan, PiggyBank $piggyBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\CashFlowPlan\PiggyBank  $piggyBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family, CashFlowPlan $cashFlowPlan, PiggyBank $piggyBank)
    {
        //
    }
}
