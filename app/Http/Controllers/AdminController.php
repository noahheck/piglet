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
        $users = User::all()->sortBy(['lastName', 'firstName']);

        return view('admin.home', [
            'key'   => 'users',
            'users' => $users,
        ]);
    }

    public function families()
    {
        $families = Family::all()->sortBy('name');

        return view('admin.home', [
            'key'      => 'families',
            'families' => $families,
        ]);
    }
}
