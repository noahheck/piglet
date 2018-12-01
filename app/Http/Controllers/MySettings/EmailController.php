<?php

namespace App\Http\Controllers\MySettings;

use App\Mail\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use function App\flashSuccess;

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

        flashSuccess('auth.email-verified');

        return redirect()->route('home');
    }

    public function requestNewPin(Request $request)
    {
        $user = Auth::user();

        $newPin = $user->setNewEmailVerificationPin();

        if (!$newPin) {
            return redirect()->back()->withErrors(['newPin' => 'An error has occurred']);
        }

        Mail::to($user)->send(new EmailVerification($user, $newPin));

        flashSuccess('auth.new-email-pin');

        return redirect()->route('user-settings.show-verify-email');
    }
}
