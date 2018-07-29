<?php

namespace App\Family;

use App\Family\CashFlowPlan\RecurringExpense;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Family\CashFlowPlan\IncomeSource;

class CashFlowPlan extends Model
{
    use SoftDeletes
        ;



    public function incomeSources()
    {
        return $this->hasMany(IncomeSource::class);
    }

    public function budgetIncomeSourcesTotal()
    {
        return $this->incomeSources->where('type', 'budget')->sum('amount');
    }

    public function actualIncomeSourcesTotal()
    {
        return $this->incomeSources->where('type', 'actual')->sum('amount');
    }



    public function recurringExpenses()
    {
        return $this->hasMany(RecurringExpense::class);
    }

    public function budgetRecurringExpensesTotal()
    {
        return $this->recurringExpenses->where('type', 'budget')->sum('amount');
    }

    public function actualRecurringExpensesTotal()
    {
        return $this->recurringExpenses->where('type', 'actual')->sum('amount');
    }
}
