<?php

namespace App\Http\Controllers\Family\CashFlowPlan;

use App\Family;
use App\Family\CashFlowPlan;
use App\Family\CashFlowPlan\Expense;
use App\Family\CashFlowPlan\ExpenseGroup;
use App\Family\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use function App\flashSuccess;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family, CashFlowPlan $cashFlowPlan)
    {
        $categories = Category::orderBy('active', 'DESC')->orderBy('d_order')->get();

        $expenses = $cashFlowPlan->expenses()->orderBy('date')->get();

        $expenses->load('merchant');

        return view('family.cash-flow-plans.expenses.home', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'categories'   => $categories,
            'expenses'     => $expenses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Family $family, CashFlowPlan $cashFlowPlan)
    {
        $expense = new Expense();

        if ($request->query('expense_group_id')) {
            $expense_group_id = $request->query('expense_group_id');

            $expense->expense_group_id = $expense_group_id;

            $expenseGroup = ExpenseGroup::find($expense_group_id);

            $expense->category_id = $expenseGroup->category_id;
            $expense->sub_category = $expenseGroup->sub_category;
        }

        return view('family.cash-flow-plans.expenses.new', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'expense'      => $expense,
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
        $request->validate(Expense::getValidations());

        $expense = new Expense();

        $expense->cash_flow_plan_id = $cashFlowPlan->id;

        $expense->fill($request->only($expense->getFillable()));

        $expense->save();

        flashSuccess("expenses.expense-created");

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.cash-flow-plans.expenses.index', [$family, $cashFlowPlan]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, CashFlowPlan $cashFlowPlan, Expense $expense)
    {
        return view('family.cash-flow-plans.expenses.show', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'expense'      => $expense,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\CashFlowPlan\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, CashFlowPlan $cashFlowPlan, Expense $expense)
    {
        return view('family.cash-flow-plans.expenses.edit', [
            'family'       => $family,
            'cashFlowPlan' => $cashFlowPlan,
            'expense'      => $expense,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\CashFlowPlan\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, CashFlowPlan $cashFlowPlan, Expense $expense)
    {
        $request->validate($expense->getValidations());

        $expense->fill($request->only($expense->getFillable()));

        $expense->save();

        flashSuccess("expenses.expense-updated");

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.cash-flow-plans.expenses.index', [$family, $cashFlowPlan]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\CashFlowPlan\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Family $family, CashFlowPlan $cashFlowPlan, Expense $expense)
    {
        $expense->delete();

        flashSuccess("expenses.expense-deleted");

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.cash-flow-plans.expenses.index', [$family, $cashFlowPlan]);
    }
}
