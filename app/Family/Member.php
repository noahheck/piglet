<?php

namespace App\Family;

use App\Traits\HasBirthdate;

class Member extends Model
{
    use HasBirthdate;

    protected $dates = [
        'created_at',
        'updated_at',
        'birthdate',
    ];
}
