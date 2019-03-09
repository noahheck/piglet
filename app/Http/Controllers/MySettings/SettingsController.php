<?php

namespace App\Http\Controllers\MySettings;

use App\Mail\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        return view("user-settings/home", [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate(User::getValidations($user->id));

        $user->fill($request->only(['firstName', 'lastName', 'email', 'timezone', 'background_color']));

        $user->events_email = $request->has('events_email');

        $pin  = false;
        if ($user->isDirty('email')) {
            $pin = $user->setNewEmailVerificationPin();
        }

        $user->save();

        if ($pin !== false) {
            Mail::to($user)->send(new EmailVerification($user, $pin));
        }

        $request->session()->flash('user-settings-success', 'User details saved successfully');

        return redirect()->route("user-settings");
    }
}
