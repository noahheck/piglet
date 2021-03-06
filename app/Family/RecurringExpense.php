<?php

namespace App\Family;

class RecurringExpense extends Model
{
    protected $fillable = [
        'name',
        'default_amount',
        'merchant_id',
        'category_id',
        'sub_category',
        'description',
    ];

    public static function getValidations()
    {
        return [
            'name' => 'required',
            'merchant' => 'integer|nullable',
            'category' => 'integer|nullable',
        ];
    }

    protected $casts = [
        'active' => 'boolean',
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function recurringExpenseInstances()
    {
        return $this->hasMany(\App\Family\CashFlowPlan\RecurringExpense::class);
    }
}
