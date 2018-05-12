<?php

namespace App\Http\Controllers;

use App\Family;
use App\FamilyUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('family/new', [
            'family' => new Family,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Family::getValidations());

        $family = Family::createNew($request->only(['name', 'details']), Auth::user(), $request->file('familyPhoto'));

        if ($family) {
            $request->session()->flash('family.create-success', 'Family created successfully');
        }

        return redirect()->to(route("family.home", $family));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        return view('family/edit', [
            'family' => $family,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        $family->update($request->only(['name', 'details']));
        $family->save();

        if ($photoFile = $request->file('familyPhoto')) {
            $family->updateFamilyPhoto($photoFile);
        }

        return redirect()->route('family.home', $family);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        //
    }

    /**
     * Downloads the family photo for the $family
     *
     * @param Family $family
     * @return mixed
     */
    public function photo(Family $family, Request $request)
    {
        $lastModified = new \DateTime($family->image_updated_at);

        $response = new Response();
        $response->setLastModified($lastModified);

        if ($response->isNotModified($request)) {
            return $response;
        }

        return Storage::disk('family')
            ->download($family->imageFile())
            ->setLastModified($lastModified)
            ->setPublic();
    }

}
