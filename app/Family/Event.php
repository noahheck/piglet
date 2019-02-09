<?php

namespace App\Family;

use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'date',
        'time',
        'details',
    ];

    protected $casts = [
        'all_day' => 'boolean',
    ];

    public static function getValidations()
    {
        return [
            'title' => 'required',
            'date'  => 'required|date',
        ];
    }
}
