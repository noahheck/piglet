<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    const MIN_PASSWORD_LENGTH = 8;

    static public function getValidations($userId = null)
    {
        $email  = 'required|email|unique:users,email';
        $email .= ($userId) ? ",$userId" : '';

        return [
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => $email
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
