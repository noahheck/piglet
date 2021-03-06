<?php

namespace App\Http\Controllers;

use App\Family;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $numUsers = User::count();

        $numFamilies = Family::count();

        $numFamiliesInSupportMode = Family::where('allow_support_access', true)->count();

        return view('admin.home', [
            'key'         => null,
            'numUsers'    => $numUsers,
            'numFamilies' => $numFamilies,
            'numFamiliesInSupportMode' => $numFamiliesInSupportMode,
        ]);
    }

    public function users()
    {
        $users = User::orderBy('lastName')->orderBy('firstName')->get();

        return view('admin.home', [
            'key'   => 'users',
            'users' => $users,
        ]);
    }

    public function deleteUser(User $user)
    {
        if ($user->email_verified) {
            \App\flashError("Unable to delete: email is verified");
            return redirect()->route('admin.users');
        }

        $user->delete();

        \App\flashSuccess('User deleted');

        return redirect()->route('admin.users');
    }

    public function families()
    {
        $families = Family::orderBy('name')->get();

        return view('admin.home', [
            'key'      => 'families',
            'families' => $families,
        ]);
    }

    public function support()
    {
        $families = Family::where('allow_support_access', true)->get();

        return view('admin.home', [
            'key'      => 'support',
            'families' => $families,
        ]);
    }
}
