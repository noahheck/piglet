<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'details',
    ];

    public static function getValidations()
    {
        return [
            'name' => 'required|max:255',
        ];
    }
}
