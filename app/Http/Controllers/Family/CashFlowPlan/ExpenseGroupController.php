<?php

namespace App\Http\Controllers\Family\CashFlowPlan;

use App\Family;
use App\Family\CashFlowPlan;
use App\Family\CashFlowPlan\ExpenseGroup;
use App\Family\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function App\flashSuccess;

class ExpenseGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family, CashFlowPlan $cashFlowPlan)
    {
        $categories = Category::orderBy('active', 'DESC')->orderBy('d_order')->get();

        $expenseGroups = $cashFlowPlan->expenseGroups()->orderBy('name')->get();

        return view('family.cash-flow-plans.expense-groups.home', [
            'family'        => $family,
            'cashFlowPlan'  => $cashFlowPlan,
            'categories'    => $categories,
            'expenseGroups' => $expenseGroups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family, CashFlowPlan $cashFlowPlan)
    {
        $expenseGroup = new ExpenseGroup();

        return view('family.cash-flow-plans.expense-groups.new', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'expenseGroup' => $expenseGroup,
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
        $request->validate(ExpenseGroup::getValidations());

        $expenseGroup = new ExpenseGroup();

        $expenseGroup->cash_flow_plan_id = $cashFlowPlan->id;

        $expenseGroup->fill($request->only($expenseGroup->getFillable()));

        $expenseGroup->save();

        flashSuccess("expense-groups.expense-group-created");

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.cash-flow-plans.expense-groups.index', [$family, $cashFlowPlan]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\ExpenseGroup  $expenseGroup
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, CashFlowPlan $cashFlowPlan, ExpenseGroup $expenseGroup)
    {
        return view('family.cash-flow-plans.expense-groups.show', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'expenseGroup' => $expenseGroup,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\ExpenseGroup  $expenseGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, CashFlowPlan $cashFlowPlan, ExpenseGroup $expenseGroup)
    {
        return view('family.cash-flow-plans.expense-groups.edit', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'expenseGroup' => $expenseGroup,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\CashFlowPlan\ExpenseGroup  $expenseGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, CashFlowPlan $cashFlowPlan, ExpenseGroup $expenseGroup)
    {
        $request->validate($expenseGroup->getValidations());

        $expenseGroup->fill($request->only($expenseGroup->getFillable()));

        $expenseGroup->save();

        flashSuccess("expense-groups.expense-group-updated");

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.cash-flow-plans.expense-groups.index', [$family, $cashFlowPlan]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\CashFlowPlan\ExpenseGroup  $expenseGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family, CashFlowPlan $cashFlowPlan, ExpenseGroup $expenseGroup)
    {
        $expenseGroup->delete();

        flashSuccess("expense-groups.expense-group-deleted");

        return redirect()->route('family.cash-flow-plans.expense-groups.index', [$family, $cashFlowPlan]);
    }
}
