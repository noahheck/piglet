<?php

namespace App\Http\Controllers\MySettings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\User;

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

        $user->fill($request->only(['firstName', 'lastName', 'email']));

        $user->save();

        $request->session()->flash('user-settings-success', 'User details saved successfully');

        return redirect()->route("user-settings");
    }
}
