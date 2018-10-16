<?php

namespace App\Traits\CashFlowPlan;

trait StoresLifestyleExpenses
{
    public static function lifestyleExpensesValidations()
    {
        return [
            'pocket_money' => 'numeric|nullable',
            'retirement'   => 'numeric|nullable',
            'education'    => 'numeric|nullable',
        ];
    }
}
