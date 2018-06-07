<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\Member;
use App\Invitation;
use App\Mail\Invitation as InvitationEmail;
use App\Service\PhotoUploaderService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        return view('family.members.home', [
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

        $member->color = Member::COLOR_DEFAULT;

        return view('family.members.new', [
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

        $member->allow_login      = $request->has('allow_login');
        $member->is_administrator = $request->has('is_administrator');

        $member->save();

        if ($member->allow_login && $member->login_email) {
            $invitation = new Invitation();

            $invitation->family_id = $family->id;
            $invitation->member_id = $member->id;
            $invitation->email     = $member->login_email;

            $invitation->save();

            Mail::to($member->login_email)->send(new InvitationEmail(Auth::user(), $member));
        }

        if ($photoFile = $request->file('memberPhoto')) {
            $member->uploadPhoto($photoFile, $photoUploaderService);
        }

        return redirect()->route('family.members.show', [$family, $member]);
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

        return view('family.members.show', [
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

        return view('family.members.edit', [
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

        $oldLoginEmail = $member->login_email;

        $member->fill($request->only($member->getFillable()));

        $member->allow_login      = $request->has('allow_login');
        $member->is_administrator = $request->has('is_administrator');

        $grantAccess  = false;
        $removeAccess = false;

        if ($member->isDirty('allow_login') || $member->isDirty('login_email')) {

            if ($member->allow_login) {
                $grantAccess  = true;
            } else {
                $removeAccess = true;
            }
        }

        /**
         * If the member hasn't accepted their invitation yet, we can re-invite them
         */
        if ($member->allow_login && !$member->user_id) {
            $grantAccess = true;
        }

        if ($member->isDirty('login_email')) {
            $removeAccess = true;
        }

        $member->save();

        if ($grantAccess) {

            $existingInvitation = Invitation::where([
                ['family_id', '=', $family->id],
                ['member_id', '=', $member->id],
            ])->whereNull('accepted_date')
            ->count();

            if (!$existingInvitation) {
                $invitation = new Invitation();

                $invitation->family_id = $family->id;
                $invitation->member_id = $member->id;
                $invitation->email     = $member->login_email;

                $invitation->save();
            }

            /**
             * If the member hasn't established an account yet, we'll email them the instructions on how to sign up
             */
            if (!$member->user_id) {
                Mail::to($member->login_email)->send(new InvitationEmail(Auth::user(), $member));
            }
        }

        if ($removeAccess) {
            Invitation::where([
                    'family_id' => $family->id,
                    'email'     => $oldLoginEmail,
                ])
                ->whereNull('accepted_date')
                ->delete();

            if ($member->user_id) {
                $user = User::find($member->user_id);

                $user->families()->detach($family);
            }
        }

        if ($photoFile = $request->file('memberPhoto')) {
            $member->uploadPhoto($photoFile, $photoUploaderService);
        }

        return redirect()->route('family.members.show', [$family, $member]);
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
