<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\ExpenseGroup;
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
    public function index(Family $family)
    {
        $expenseGroups = ExpenseGroup::orderBy('active', 'DESC')->orderBy('name')->get();

        return view('family.expense-groups.home', [
            'family'        => $family,
            'expenseGroups' => $expenseGroups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        $expenseGroup = new ExpenseGroup();
        $expenseGroup->active = true;


        return view('family.expense-groups.new', [
            'family'       => $family,
            'expenseGroup' => $expenseGroup,
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
        $request->validate(ExpenseGroup::getValidations());

        $expenseGroup = new ExpenseGroup();

        $expenseGroup->fill($request->only($expenseGroup->getFillable()));

        $expenseGroup->active = $request->has('active');
        $expenseGroup->cash   = $request->has('cash');

        $expenseGroup->save();

        flashSuccess('expense-groups.expense-group-created');

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.expense-groups.index', [$family]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\ExpenseGroup  $expenseGroup
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, ExpenseGroup $expenseGroup)
    {
        return view('family.expense-groups.show', [
            'family'       => $family,
            'expenseGroup' => $expenseGroup,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\ExpenseGroup  $expenseGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, ExpenseGroup $expenseGroup)
    {
        return view('family.expense-groups.edit', [
            'family'       => $family,
            'expenseGroup' => $expenseGroup,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\ExpenseGroup  $expenseGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, ExpenseGroup $expenseGroup)
    {
        $request->validate($expenseGroup->getValidations());

        $expenseGroup->fill($request->only($expenseGroup->getFillable()));

        $expenseGroup->active = $request->has('active');
        $expenseGroup->cash   = $request->has('cash');

        $expenseGroup->save();

        flashSuccess('expense-groups.expense-group-updated');

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.expense-groups.index', [$family]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\ExpenseGroup  $expenseGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family, ExpenseGroup $expenseGroup)
    {
        //
    }
}
