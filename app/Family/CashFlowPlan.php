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

    public function projectedIncomeSourcesTotal()
    {
        return $this->incomeSources->sum('projected');

    }

    public function actualIncomeSourcesTotal()
    {
        return $this->incomeSources->sum('actual');
    }



    public function recurringExpenses()
    {
        return $this->hasMany(RecurringExpense::class);
    }

    public function projectedRecurringExpensesTotal()
    {
        return $this->recurringExpenses->sum('projected');
    }

    public function actualRecurringExpensesTotal()
    {
        return $this->recurringExpenses->sum('actual');
    }
}
