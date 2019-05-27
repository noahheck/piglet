<?php

namespace App\Traits\CashFlowPlan;


trait ProcessesRecurringExpenses
{
    public function projectedRecurringExpensesTotal()
    {
        return $this->recurringExpenses->sum('projected');
    }

    public function actualRecurringExpensesTotal()
    {
        return $this->recurringExpenses->sum('actual');
    }

    public function recurringExpensesActualVsProjected()
    {
        return $this->actualRecurringExpensesTotal() - $this->projectedRecurringExpensesTotal();
    }

    public function recurringExpensesOverspent()
    {
        return $this->actualRecurringExpensesTotal() > $this->projectedRecurringExpensesTotal();
    }

    public function recurringExpensesCloseToOverspent()
    {
        return (($this->actualRecurringExpensesTotal() / $this->projectedRecurringExpensesTotal()) * 100) >= 90;
    }

    public function hasRecurringExpensesForCategory($categoryId = null)
    {
        return $this->recurringExpenses->where('category_id', $categoryId)->count() > 0;
    }

    public function recurringExpenseCategoryProjectedTotal($categoryId = null)
    {
        return $this->recurringExpenses->where('category_id', $categoryId)->sum('projected');
    }

    public function recurringExpenseCategoryActualTotal($categoryId = null)
    {
        return $this->recurringExpenses->where('category_id', $categoryId)->sum('actual');
    }

    public function recurringExpenseCategoryActualVsProjected($categoryId = null)
    {
        return    $this->recurringExpenseCategoryActualTotal($categoryId)
            - $this->recurringExpenseCategoryProjectedTotal($categoryId);
    }

    public function recurringExpenseCategoryPercentUtilized($categoryId = null)
    {
        if (!$this->recurringExpenseCategoryProjectedTotal($categoryId)) {
            return null;
        }

        return (
                $this->recurringExpenseCategoryActualTotal($categoryId)
                / $this->recurringExpenseCategoryProjectedTotal($categoryId)
            ) * 100;
    }

    public function recurringExpenseCategoryIsOverspent($categoryId = null)
    {
        return $this->recurringExpenseCategoryPercentUtilized($categoryId) > 100;
    }

    public function recurringExpenseCategoryIsCloseToOverspent($categoryId = null)
    {
        return $this->recurringExpenseCategoryPercentUtilized($categoryId) >= 90;
    }

    public function recurringExpenseCategoryPaymentsMade($categoryId = null)
    {
        return $this->recurringExpenses->where('category_id', $categoryId)->reduce(function($carry, $expense) {
            return ($expense->actual) ? ++$carry : $carry;
        }, 0);
    }

    public function recurringExpenseCategoryPaymentsExpected($categoryId = null)
    {
        return $this->recurringExpenses->where('category_id', $categoryId)->count();
    }

    public function recurringExpenseCategoryAllPaymentsMade($categoryId = null)
    {
        return  $this->recurringExpenseCategoryPaymentsMade($categoryId)
            === $this->recurringExpenseCategoryPaymentsExpected($categoryId);
    }

    public function recurringExpenseCategoryPercentPaymentsMade($categoryId = null)
    {
        if (!$this->recurringExpenseCategoryPaymentsExpected($categoryId)) {
            return null;
        }

        return (
                $this->recurringExpenseCategoryPaymentsMade($categoryId)
                / $this->recurringExpenseCategoryPaymentsExpected($categoryId)
            ) * 100;
    }


    /**
     * Returns whether the category provided has any zero dollar projected amounts - If an expense has been paid, it is
     * not considered a zero dollar projected amount because the amount is already known.
     *
     * @param null $categoryId
     * @return bool
     */
    public function recurringExpenseCategoryHasMissingProjectedValue($categoryId = null)
    {
        $recurringExpenses = $this->recurringExpenses->where('category_id', $categoryId)->filter(function($expense, $key) {
            return $expense->projected == 0 && $expense->actual == 0;
        });

        return $recurringExpenses->count() > 0;
    }


    public function hasRecurringExpense($template)
    {
        return $this->recurringExpenses->pluck('recurring_expense_id')->contains($template->id);
    }
}