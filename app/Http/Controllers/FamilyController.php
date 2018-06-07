<?php

namespace App\Http\Controllers;

use App\Family;
use App\FamilyUser;
use App\Service\FamilyConnectService;
use App\Service\PhotoUploaderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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
    public function store(
        Request $request,
        PhotoUploaderService $photoUploaderService,
        FamilyConnectService $connectService
    ) {
        $request->validate(Family::getValidations());

        $family = Family::createNew(
            $request->only(['name', 'details']),
            Auth::user(),
            $request->file('familyPhoto'),
            $photoUploaderService,
            $connectService
        );

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
        if (!Auth::user()->member->is_administrator) {
            throw new AccessDeniedHttpException("You need to be an administrator to update this family");
        }

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
    public function update(Request $request, Family $family, PhotoUploaderService $photoUploaderService)
    {
        if (!Auth::user()->member->is_administrator) {
            throw new AccessDeniedHttpException("You need to be an administrator to update this family");
        }

        $request->validate(Family::getValidations());

        $family->update($request->only(['name', 'details']));
        $family->save();

        if ($photoFile = $request->file('familyPhoto')) {
            $family->uploadPhoto($photoFile, $photoUploaderService);
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
    public function photo(Family $family, $size, Request $request)
    {
        $lastModified = new \DateTime($family->image_updated_at);

        $response = new Response();
        $response->setLastModified($lastModified);

        if ($response->isNotModified($request)) {
            return $response;
        }

        return response()->file(Storage::disk('family')->path($family->imageFile($size)))
            ->setLastModified($lastModified)
            ->setPublic();
    }

}
