<?php

namespace App\Family;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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


    public function scopeOrderByDateDescending($query)
    {
        return $query->orderBy(DB::raw("(substr(date, 7, 4) || '-' || substr(date, 1, 2) || '-' || substr(date, 4, 2))"), 'DESC');
    }

    public function isBirthday()
    {
        return false;
    }
}
