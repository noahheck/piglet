<?php

namespace App\Family;

use App\Traits\HasPhoneNumber;
use App\Traits\HasSecondaryPhoneNumber;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use SoftDeletes,
        HasPhoneNumber,
        HasSecondaryPhoneNumber
    {
        HasPhoneNumber::formatForDatabase insteadof HasSecondaryPhoneNumber;
        HasPhoneNumber::formatForOutput insteadof HasSecondaryPhoneNumber;
    }

    protected $fillable = [
        'name',
        'details',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'phone',
        'secondaryPhone',
        'url',
    ];

    public static function getValidations()
    {
        return [
            'name' => 'required',

        ];
    }
}
