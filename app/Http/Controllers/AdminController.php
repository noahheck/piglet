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

        return view('admin.home', [
            'key'         => null,
            'numUsers'    => $numUsers,
            'numFamilies' => $numFamilies,
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

    public function families()
    {
        $families = Family::orderBy('name')->get();

        return view('admin.home', [
            'key'      => 'families',
            'families' => $families,
        ]);
    }
}
