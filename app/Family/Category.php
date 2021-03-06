<?php

namespace App\Family;

use App\Family\CashFlowPlan\Expense;
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

    public function recurringExpenseInstances()
    {
        return $this->hasMany(\App\Family\CashFlowPlan\RecurringExpense::class);
    }

    public function expenseGroups()
    {
        return $this->hasMany(ExpenseGroup::class);
    }

    public function expenseGroupInstances()
    {
        return $this->hasMany(\App\Family\CashFlowPlan\ExpenseGroup::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
