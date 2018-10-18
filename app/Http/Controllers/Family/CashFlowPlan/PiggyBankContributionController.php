<?php

namespace App\Http\Controllers\Family\CashFlowPlan;

use App\Family\CashFlowPlan\PiggyBankContribution;
use App\Family\PiggyBank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Family;
use App\Family\CashFlowPlan;

use function App\flashSuccess;

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

        $contributions->load('piggyBank');

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
    public function create(Request $request, Family $family, CashFlowPlan $cashFlowPlan)
    {
        $contribution = new PiggyBankContribution();

        if ($request->query('piggy_bank_id')) {
            $contribution->piggy_bank_id = $request->query('piggy_bank_id');
        }

//        $piggyBanks = PiggyBank::where('active', true)->orderBy('dueDate')->get();

        $piggyBanks = $cashFlowPlan->piggyBanks()->orderBy('dueDate')->get();

        return view('family.cash-flow-plans.piggy-bank-contributions.new', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'contribution' => $contribution,
            'piggyBanks'   => $piggyBanks,
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
        $request->validate(PiggyBankContribution::getValidations());

        $contribution = new PiggyBankContribution();

        $contribution->cash_flow_plan_id = $cashFlowPlan->id;

        $contribution->fill($request->only($contribution->getFillable()));

        $contribution->save();

        flashSuccess("piggy-banks.contribution-created");

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.cash-flow-plans.piggy-bank-contributions.index', [$family, $cashFlowPlan]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\PiggyBankContribution  $piggyBankContribution
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, CashFlowPlan $cashFlowPlan, PiggyBankContribution $piggyBankContribution)
    {
        return view('family.cash-flow-plans.piggy-bank-contributions.show', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'contribution' => $piggyBankContribution,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\PiggyBankContribution  $piggyBankContribution
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, CashFlowPlan $cashFlowPlan, PiggyBankContribution $piggyBankContribution)
    {
//        $piggyBanks = PiggyBank::where('active', true)->orderBy('dueDate')->get();

        $piggyBanks = $cashFlowPlan->piggyBanks()->orderBy('dueDate')->get();

        if (!$piggyBanks->contains($piggyBankContribution->piggyBank)) {
            $piggyBanks->prepend($piggyBankContribution->piggyBank);
        }

        return view('family.cash-flow-plans.piggy-bank-contributions.edit', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'contribution' => $piggyBankContribution,
            'piggyBanks'   => $piggyBanks,
        ]);
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
        $request->validate($piggyBankContribution->getValidations());

        $piggyBankContribution->fill($request->only($piggyBankContribution->getFillable()));

        $piggyBankContribution->save();

        flashSuccess("piggy-banks.contribution-updated");

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.cash-flow-plans.piggy-bank-contributions.index', [$family, $cashFlowPlan]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\CashFlowPlan\PiggyBankContribution  $piggyBankContribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Family $family, CashFlowPlan $cashFlowPlan, PiggyBankContribution $piggyBankContribution)
    {
        $piggyBankContribution->delete();

        flashSuccess("piggy-banks.contribution-deleted");

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.cash-flow-plans.piggy-bank-contributions.index', [$family, $cashFlowPlan]);
    }
}
