<?php

namespace App\Http\Controllers\Family\CashFlowPlan;

use App\Family;
use App\Family\CashFlowPlan;
use App\Family\CashFlowPlan\IncomeSource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncomeSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family, CashFlowPlan $cashFlowPlan)
    {
//        $cashFlowPlanIncomeSources = $cashFlowPlan->
        $cashFlowPlanIncomeSources = false;

        return view('family.cash-flow-plans.income-sources.home', [
            'family'                    => $family,
            'cashFlowPlan'              => $cashFlowPlan,
            'cashFlowPlanIncomeSources' => $cashFlowPlanIncomeSources,
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\IncomeSource  $cashFlowPlanIncomeSource
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, CashFlowPlan $cashFlowPlan, IncomeSource $incomeSource)
    {
        \DebugBar::info($incomeSource);

        return view('family.cash-flow-plans.income-sources.show', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'incomeSource' => $incomeSource,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\IncomeSource  $cashFlowPlanIncomeSource
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomeSource $cashFlowPlanIncomeSource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\IncomeSource  $cashFlowPlanIncomeSource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncomeSource $cashFlowPlanIncomeSource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\IncomeSource  $cashFlowPlanIncomeSource
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomeSource $cashFlowPlanIncomeSource)
    {
        //
    }
}
