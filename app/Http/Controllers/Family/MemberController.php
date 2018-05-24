<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\Member;
use App\Service\PhotoUploaderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family)
    {
        $members = Member::all();

        return view('family.member.home', [
            'family'  => $family,
            'members' => $members,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        $member = new Member();

        $member->color = '#6a8aaa';

        return view('family.member.create', [
            'family' => $family,
            'member' => $member,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Family $family, Request $request, PhotoUploaderService $photoUploaderService)
    {
        $request->validate(Member::getValidations());

        $member = new Member();

        $member->fill($request->only($member->getFillable()));

        $member->family = $family->id;

        $member->save();

        if ($photoFile = $request->file('memberPhoto')) {
            $member->uploadPhoto($photoFile, $photoUploaderService);
        }

        return redirect()->route('family.member.show', [$family, $member]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, $id)
    {
        $member = Member::find($id);

        return view('family.member.show', [
            'family' => $family,
            'member' => $member,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, $id)
    {
        $member = Member::find($id);

        return view('family.member.edit', [
            'family' => $family,
            'member' => $member,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, $id, PhotoUploaderService $photoUploaderService)
    {
        $request->validate(Member::getValidations());

        $member = Member::find($id);

        $member->fill($request->only($member->getFillable()));

        $member->save();

        if ($photoFile = $request->file('memberPhoto')) {
            $member->uploadPhoto($photoFile, $photoUploaderService);
        }

        return redirect()->route('family.member.show', [$family, $member]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    /**
     * Downloads the family photo for the $family
     *
     * @param Family $family
     * @return mixed
     */
    public function photo(Family $family, Member $member, $size, Request $request)
    {
        $lastModified = new \DateTime($member->image_updated_at);

        $response = new Response();
        $response->setLastModified($lastModified);

        if ($response->isNotModified($request)) {
            return $response;
        }

        return response()->file(Storage::disk('family')->path($member->imageFile($size)))
            ->setLastModified($lastModified)
            ->setPublic();
    }
}
