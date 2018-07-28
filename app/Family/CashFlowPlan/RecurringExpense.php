<?php

namespace App\Family\CashFlowPlan;

use App\Family\Category;
use App\Family\Merchant;
use App\Family\Model;
use App\Traits\PopulatesCashFlowPlan;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Family\CashFlowPlan;

class RecurringExpense extends Model
{
    use SoftDeletes,
        PopulatesCashFlowPlan;

    protected $table = 'cash_flow_plan_recurring_expenses';

    protected $dates = [
        'date',
    ];

    protected $fillable = [
        'recurring_expense_id',
        'merchant_id',
        'category_id',
        'sub_category',
        'name',
        'type',
        'amount',
        'date',
        'payment_detail',
        'detail',
    ];

    public static function getValidations()
    {
        return [
            'name'                 => 'required',
            'recurring_expense_id' => 'integer|nullable',
            'type'                 => 'required|in:budget,actual',
            'date'                 => 'date|nullable',
        ];
    }

    public function cashFlowPlan()
    {
        return $this->belongsTo(CashFlowPlan::class);
    }

    public function recurringExpenseTemplate()
    {
        return $this->belongsTo(\App\Family\RecurringExpense::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
