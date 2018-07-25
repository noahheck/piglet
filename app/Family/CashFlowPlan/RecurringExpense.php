<?php

namespace App\Family\CashFlowPlan;

use App\Family\Category;
use App\Family\Merchant;
use App\Family\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Family\CashFlowPlan;

class RecurringExpense extends Model
{
    use SoftDeletes;

    protected $table = 'cash_flow_plan_recurring_expenses';

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
