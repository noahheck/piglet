<?php

namespace App\Http\Controllers;


use App\Family\Member;
use App\FamilyUser;
use App\Invitation;
use App\Service\FamilyConnectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{

    /**
     * @param Request $request
     * @param Invitation $invitation
     * @throws \Exception
     */
    public function accept(Request $request, Invitation $invitation, FamilyConnectService $service)
    {
        $user = Auth::user();

        if (   $invitation->accepted_date
            || $user->email !== $invitation->email
        ) {
            throw new \Exception("The invitation is no longer valid");
        }

        $family = $invitation->family;

        $invitation->user_id       = $user->id;
        $invitation->accepted_date = new \DateTime();

        $invitation->save();

        $familyUser = new FamilyUser();
        $familyUser->family_id       = $family->id;
        $familyUser->user_id         = $user->id;
        $familyUser->active          = true;
        $familyUser->isAdministrator = false;

        $familyUser->save();

        $service->connectToFamily($family);

        $member = Member::find($invitation->member_id);
        $member->user_id = $user->id;
        $member->save();


        return redirect()->route('family.home', $family);
    }

}
