<?php

namespace App\Family;

use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'color',
        'description',
        'sub_categories',
    ];

    protected $casts = [
        'active'         => 'boolean',
        'sub_categories' => 'array',
    ];

    public static function getValidations()
    {
        return [
            'name' => 'required',
            'sub_categories' => 'array|nullable',
        ];
    }



    public function merchants()
    {
        return $this->hasMany(Merchant::class, 'default_category_id');
    }

    public function recurringExpenses()
    {
        return $this->hasMany(RecurringExpense::class);
    }

}
