<?php

namespace App\Traits\CashFlowPlan;


trait ProcessesExpenseGroups
{
    public function hasExpenseGroupTemplate($template)
    {
        return $this->expenseGroups->pluck('expense_group_id')->contains($template->id);
    }

    public function expenseGroupsProjectedTotal()
    {
        return $this->expenseGroups->sum('projected');
    }

    public function expenseGroupsOverspent()
    {
        return $this->expenseGroupsActualVsProjected() > 0;
    }
}