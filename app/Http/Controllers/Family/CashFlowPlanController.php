<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\CashFlowPlan;
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

        $years = array_reverse(range($minYear, $nextYear));

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
        //
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
