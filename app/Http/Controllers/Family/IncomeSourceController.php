<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\IncomeSource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncomeSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family)
    {
        $incomeSources = IncomeSource::orderBy('active', 'DESC')->orderBy('name')->get();

        return view('family.income-sources.home', [
            'family'        => $family,
            'incomeSources' => $incomeSources,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        $incomeSource         = new IncomeSource();
        $incomeSource->active = true;

        return view('family.income-sources.new', [
            'family'       => $family,
            'incomeSource' => $incomeSource,
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
        $request->validate(IncomeSource::getValidations());

        $incomeSource = new IncomeSource();
        $incomeSource->fill($request->only($incomeSource->getFillable()));

        $incomeSource->active = $request->has('active');

        $incomeSource->save();

        return redirect()->route('family.income-sources.show', [$family, $incomeSource]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\IncomeSource  $incomeSource
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, IncomeSource $incomeSource)
    {
        return view('family.income-sources.show', [
            'family'       => $family,
            'incomeSource' => $incomeSource
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\IncomeSource  $incomeSource
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, IncomeSource $incomeSource)
    {
        return view('family.income-sources.edit', [
            'family'       => $family,
            'incomeSource' => $incomeSource,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\IncomeSource  $incomeSource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, IncomeSource $incomeSource)
    {
        $request->validate($incomeSource->getValidations());

        $incomeSource->fill($request->only($incomeSource->getFillable()));

        $incomeSource->active = $request->has('active');

        $incomeSource->save();

        return redirect()->route('family.income-sources.show', [$family, $incomeSource]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\IncomeSource  $incomeSource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family, IncomeSource $incomeSource)
    {
        //
    }
}
