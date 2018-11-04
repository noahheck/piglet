<?php

namespace App\Http\Controllers\Family\CashFlowPlan;

use App\Family;
use App\Family\CashFlowPlan;
use App\Family\CashFlowPlan\PiggyBank;
use App\Family\PiggyBank as FamilyPiggyBank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function App\flashSuccess;

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
        $piggyBank = new PiggyBank();

        return view('family.cash-flow-plans.piggy-banks.new', [
            'family' => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'piggyBank' => $piggyBank,
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
        $request->validate(PiggyBank::getValidations());

        // Check if cfp already has this piggy bank
        $familyPiggyBank = new FamilyPiggyBank();
        $familyPiggyBank->id = $request->get('piggy_bank_id');

        if ($cashFlowPlan->hasPiggyBank($familyPiggyBank)) {
            return redirect()->back()->withErrors(['piggy_bank_id' => __('piggy-banks.piggy-bank') . ' ' . __('form.already-in-use')]);
        }

        $piggyBank = new PiggyBank();

        $piggyBank->cash_flow_plan_id = $cashFlowPlan->id;

        $piggyBank->fill($request->only($piggyBank->getFillable()));

        $piggyBank->save();

        flashSuccess("piggy-banks.piggy-bank-created");

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.cash-flow-plans.piggy-banks.index', [$family, $cashFlowPlan]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\PiggyBank  $piggyBank
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, CashFlowPlan $cashFlowPlan, PiggyBank $piggyBank)
    {
        return view('family.cash-flow-plans.piggy-banks.show', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'piggyBank'    => $piggyBank,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\PiggyBank  $piggyBank
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, CashFlowPlan $cashFlowPlan, PiggyBank $piggyBank)
    {
        return view('family.cash-flow-plans.piggy-banks.edit', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'piggyBank'    => $piggyBank,
        ]);
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
        $request->validate($piggyBank->getValidations());

        $piggyBank->fill($request->only($piggyBank->getFillable()));

        $piggyBank->save();

        flashSuccess("piggy-banks.piggy-bank-updated");

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.cash-flow-plans.piggy-banks.index', [$family, $cashFlowPlan]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\CashFlowPlan\PiggyBank  $piggyBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family, CashFlowPlan $cashFlowPlan, PiggyBank $piggyBank)
    {
        foreach ($piggyBank->contributions() as $contribution) {
            $contribution->delete();
        }

        flashSuccess("piggy-banks.piggy-bank-deleted");

        $piggyBank->delete();

        return redirect()->route('family.cash-flow-plans.piggy-banks.index', [$family, $cashFlowPlan]);
    }
}
