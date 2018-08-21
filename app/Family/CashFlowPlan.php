<?php

namespace App\Family;

use App\Family\CashFlowPlan\RecurringExpense;
use Illuminate\Database\Eloquent\Collection;
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


    public function allActualExpensesTotal()
    {
        return $this->actualRecurringExpensesTotal();
    }



    /**
     * @param $year
     * @param $month
     * @param Collection $incomeSources
     * @param Collection $recurringExpenses
     * @return CashFlowPlan
     */
    public static function createNew($year, $month, $incomeSources, $recurringExpenses)
    {
        $cashFlowPlan = new CashFlowPlan();

        $cashFlowPlan->year    = $year;
        $cashFlowPlan->month   = $month;
        $cashFlowPlan->details = '';

        $cashFlowPlan->save();

        $incomeSources->each(function($incomeSourceTemplate) use ($cashFlowPlan) {
            $incomeSource = new IncomeSource();

            $incomeSource->cash_flow_plan_id = $cashFlowPlan->id;
            $incomeSource->fill([
                'income_source_id' => $incomeSourceTemplate->id,
                'name'             => $incomeSourceTemplate->name,
                'projected'        => $incomeSourceTemplate->default_amount,
            ]);

            $incomeSource->save();
        });

        $recurringExpenses->each(function($recurringExpenseTemplate) use ($cashFlowPlan) {
            $recurringExpense = new RecurringExpense();

            $recurringExpense->cash_flow_plan_id = $cashFlowPlan->id;
            $recurringExpense->fill([
                'recurring_expense_id' => $recurringExpenseTemplate->id,
                'merchant_id'          => $recurringExpenseTemplate->merchant_id,
                'category_id'          => $recurringExpenseTemplate->category_id,
                'sub_category'         => $recurringExpenseTemplate->sub_category,
                'name'                 => $recurringExpenseTemplate->name,
                'projected'            => $recurringExpenseTemplate->default_amount,
            ]);

            $recurringExpense->save();
        });

        return $cashFlowPlan;
    }
}
