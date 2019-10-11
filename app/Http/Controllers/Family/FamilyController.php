<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Jobs\Family\Archive;
use App\Jobs\Family\Unarchive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use function App\flashInfo;

class FamilyController extends Controller
{
    /**
     * Show the form and warnings about how to delete the family
     *
     * @param Family $family
     * @return \Illuminate\Http\Response
     */
    public function archive(Request $request, Family $family)
    {
        if (!$request->user()->familyMember()->is_administrator) {
            throw new AccessDeniedHttpException("You need to be an administrator to update this family");
        }

        return view('family.archive', [
            'family' => $family,
        ]);
    }

    /**
     * Mark the family as archived
     *
     * @param Request $request
     * @param Family $family
     */
    public function archiveNow(Request $request, Family $family)
    {
        if (!$request->user()->familyMember()->is_administrator) {
            throw new AccessDeniedHttpException("You need to be an administrator to update this family");
        }

        $this->dispatchNow(new Archive($family, $request->user()));

        flashInfo('family-settings.family_archived');

        return redirect()->route('home');
    }

    /**
     *
     */
    public function unarchive(Request $request, Family $family)
    {
        if (!$request->user()->familyMember()->is_administrator) {
            throw new AccessDeniedHttpException("You need to be an administrator to update this family");
        }

        $this->dispatchNow(new Unarchive($family, $request->user()));

        flashInfo('family-settings.family_unarchived');

        return redirect()->route('family.home', [$family]);
    }
}
