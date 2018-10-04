<?php

namespace App\Http\Controllers\Family\CashFlowPlan;

use App\Family\CashFlowPlan\PiggyBankContribution;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Family;
use App\Family\CashFlowPlan;

class PiggyBankContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family, CashFlowPlan $cashFlowPlan)
    {
        $contributions = $cashFlowPlan->piggyBankContributions()->orderBy('date')->get();

        $contributions->load('piggy_banks');

        return view('family.cash-flow-plans.piggy-bank-contributions.home', [
            'family' => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'contributions' => $contributions,
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
     * @param  \App\Family\CashFlowPlan\PiggyBankContribution  $piggyBankContribution
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, CashFlowPlan $cashFlowPlan, PiggyBankContribution $piggyBankContribution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\PiggyBankContribution  $piggyBankContribution
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, CashFlowPlan $cashFlowPlan, PiggyBankContribution $piggyBankContribution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\CashFlowPlan\PiggyBankContribution  $piggyBankContribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, CashFlowPlan $cashFlowPlan, PiggyBankContribution $piggyBankContribution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\CashFlowPlan\PiggyBankContribution  $piggyBankContribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family, CashFlowPlan $cashFlowPlan, PiggyBankContribution $piggyBankContribution)
    {
        //
    }
}
