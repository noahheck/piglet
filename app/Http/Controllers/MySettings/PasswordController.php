<?php

namespace App\Http\Controllers\MySettings;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\User;

class PasswordController extends Controller
{
    use ResetsPasswords;

    public function index()
    {
        return view('user-settings/password', []);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->password_current, $user->password)) {
            return redirect()->back()->withErrors(['password_current' => trans("user-settings.current_password_incorrect")]);
        }

        $request->validate([
            'password' => 'required|string|min:' . User::MIN_PASSWORD_LENGTH . '|confirmed',
        ]);

        $user->password = Hash::make($request->password);

        $user->save();

        $request->session()->flash('user-settings-password-success', 'Password updated successfully');

        return redirect()->route("user-settings");
    }
}
