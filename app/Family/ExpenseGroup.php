<?php

namespace App\Family;

use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseGroup extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'default_amount',
        'category_id',
        'sub_category',
        'description',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public static function getValidations()
    {
        return [
            'name' => 'required',
            'merchant' => 'integer|nullable',
            'category' => 'integer|nullable',
        ];
    }



}
