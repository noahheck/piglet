<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Family $family, $id)
    {
        $request->validate(Member::getValidations());

        $member = Member::find($id);

        $member->fill($request->only(['firstName', 'middleName', 'lastName', 'suffix', 'birthdate']));

        $member->save();

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
}
