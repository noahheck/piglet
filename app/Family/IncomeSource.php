<?php

namespace App\Family;

use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeSource extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'default_amount',
        'details',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public static function getValidations()
    {
        return [
            'name'           => 'required',
            'default_amount' => 'numeric|nullable',
        ];
    }
}
