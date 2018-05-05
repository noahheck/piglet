<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        return view("user-settings", [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate(User::getValidations($user->id));

        $user->fill($request->only(['name', 'email']));

        $user->save();

        return redirect(route("user-settings"));
    }
}
