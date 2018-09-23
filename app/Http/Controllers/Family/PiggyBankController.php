<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\PiggyBank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PiggyBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family)
    {
        $piggyBanks = PiggyBank::orderBy('active', 'DESC')->orderBy('dueDate')->get();

        return view('family.piggy-banks.home', [
            'family'     => $family,
            'piggyBanks' => $piggyBanks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        $piggyBank = new PiggyBank;

        $piggyBank->active    = true;
        $piggyBank->completed = false;

        return view('family.piggy-banks.new', [
            'family'    => $family,
            'piggyBank' => $piggyBank,
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
        $request->validate(PiggyBank::getValidations());

        $piggyBank = new PiggyBank;

        $piggyBank->fill($request->only($piggyBank->getFillable()));

        $piggyBank->active    = $request->has('active');
        $piggyBank->completed = $request->has('completed');

        $piggyBank->save();

        return redirect()->route('family.piggy-banks.index', [$family]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\PiggyBank  $piggyBank
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, PiggyBank $piggyBank)
    {
        return view('family.piggy-banks.show', [
            'family'    => $family,
            'piggyBank' => $piggyBank,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\PiggyBank  $piggyBank
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, PiggyBank $piggyBank)
    {
        return view('family.piggy-banks.edit', [
            'family'    => $family,
            'piggyBank' => $piggyBank,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\PiggyBank  $piggyBank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, PiggyBank $piggyBank)
    {
        $request->validate($piggyBank->getValidations());

        $piggyBank->fill($request->only($piggyBank->getFillable()));

        $piggyBank->active    = $request->has('active');
        $piggyBank->completed = $request->has('completed');

        $piggyBank->save();

        if ($request->query('return')) {
            return redirect($request->query('return'));
        }

        return redirect()->route('family.piggy-banks.index', [$family]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\PiggyBank  $piggyBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family, PiggyBank $piggyBank)
    {
        //
    }
}
