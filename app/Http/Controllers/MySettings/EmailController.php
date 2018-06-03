<?php

namespace App\Http\Controllers\MySettings;

use App\Mail\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function showVerifyEmail(Request $request)
    {
        return view("user-settings/verify_email", [
            'user' => Auth::user(),
        ]);
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'verification' => 'required|int|between:100000,999999',
        ]);

        if (!Auth::user()->verifyEmail($request->verification)) {
            return redirect()->back()->withInput($request->all())->withErrors(['verification' => 'The PIN was invalid']);
        }

        $request->session()->flash('user-settings-success', 'Email verified successfully');

        return redirect()->route('user-settings');
    }

    public function requestNewPin(Request $request)
    {
        $user = Auth::user();

        $newPin = $user->setNewEmailVerificationPin();

        if (!$newPin) {
            return redirect()->back()->withErrors(['newPin' => 'An error has occurred']);
        }

        Mail::to($user)->send(new EmailVerification($user, $newPin));

        $request->session()->flash('new-user-email-verification', 'A new PIN has been emailed to you');

        return redirect()->route('user-settings.show-verify-email');
    }
}
