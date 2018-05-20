<?php

namespace App\Family;

use App\Traits\HasBirthdate;

class Member extends Model
{
    use HasBirthdate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'suffix',
        'birthdate',
    ];

    public static function getValidations()
    {
        return [
            'firstName'  => 'required|max:255',
            'middleName' => 'max:255',
            'lastName'   => 'max:255',
            'suffix'     => 'max:255',
            'birthdate'  => 'date|nullable',
        ];
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'birthdate',
    ];
}
