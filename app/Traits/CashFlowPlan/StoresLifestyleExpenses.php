<?php

namespace App\Traits\CashFlowPlan;

trait StoresLifestyleExpenses
{
    protected $lifestyleExpenseNames = [
        'pocket_money',
        'retirement',
        'education',
    ];

    public static function lifestyleExpensesValidations()
    {
        return [
            'pocket_money' => 'numeric|nullable',
            'retirement'   => 'numeric|nullable',
            'education'    => 'numeric|nullable',
        ];
    }

    public function projectedLifestyleExpensesTotal()
    {
        $total = 0;

        foreach ($this->lifestyleExpenseNames as $expense) {
            $total += $this->$expense;
        }

        return $total;
    }

    public function distributedLifestyleExpensesTotal()
    {
        $total = 0;

        foreach ($this->lifestyleExpenseNames as $expense) {
            $distributedName = $expense . '_distributed';

            if ($this->$distributedName) {
                $total += $this->$expense;
            }
        }

        return $total;
    }
}
