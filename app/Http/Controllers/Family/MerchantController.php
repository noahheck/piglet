<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Http\Controllers\Controller;

use App\Family\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family)
    {
        $merchants = Merchant::orderBy('name')->get();

        return view('family.merchants.home', [
            'family' => $family,
            'merchants' => $merchants,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        $merchant = new Merchant;

        return view('family.merchants.new', [
            'family'   => $family,
            'merchant' => $merchant,
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
        $request->validate(Merchant::getValidations());

        $merchant = new Merchant();

        $merchant->fill($request->only($merchant->getFillable()));

        $merchant->save();

        return redirect()->route('family.merchants.show', [$family, $merchant]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, Merchant $merchant)
    {
        return view('family.merchants.show', [
            'family'   => $family,
            'merchant' => $merchant,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, Merchant $merchant)
    {
        return view('family.merchants.edit', [
            'family'   => $family,
            'merchant' => $merchant,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, Merchant $merchant)
    {
        $request->validate($merchant->getValidations());

        $merchant->fill($request->only($merchant->getFillable()));

        $merchant->save();

        return redirect()->route('family.merchants.show', [$family, $merchant]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family, Merchant $merchant)
    {
        //
    }
}
