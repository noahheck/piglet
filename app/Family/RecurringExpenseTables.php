<?php


namespace App\Family;


use App\TableData;

class RecurringExpenseTables
{
    /**
     * @var RecurringExpense
     */
    private $recurringExpense;

    public function __construct(RecurringExpense $recurringExpense)
    {
        $this->recurringExpense = $recurringExpense;
    }

    public function monthlyAmountsByYearTableData()
    {
        $rowLabels = [
            __('months.jan'),
            __('months.feb'),
            __('months.mar'),
            __('months.apr'),
            __('months.may'),
            __('months.jun'),
            __('months.jul'),
            __('months.aug'),
            __('months.sep'),
            __('months.oct'),
            __('months.nov'),
            __('months.dec'),
            __('recurring-expenses.total'),
        ];

        $columnLabels = [''];
        $columnData = [];

        $instances = $this->recurringExpense->recurringExpenseInstances;

        $instances = $instances->filter(function($instance, $key) {

            return optional($instance->cashFlowPlan)->id;
        });

        if (!$instances->count()) {
            return false;
        }

        $cfps = $instances->pluck('cashFlowPlan');

        $years = $cfps->pluck('year')->unique()->sort();


        $x = 0;

        foreach ($years as $year) {

            $columnLabels[] = $year;

            $thisYearsTotal = 0;

            $thisYearsCfps = $cfps->filter(function($cfp, $key) use ($year) {

                return $cfp->year === $year;
            });


            foreach (range(1, 12) as $month) {

                $thisMonthsCfp = $thisYearsCfps->firstWhere('month', $month);

                if (!$thisMonthsCfp) {
                    $columnData[$x][] = '';

                    continue;
                }

                $thisMonthsInstance = $instances->firstWhere('cash_flow_plan_id', $thisMonthsCfp->id);

                $thisMonthsActual = ($thisMonthsInstance) ? $thisMonthsInstance->actual : 0;

                $columnData[$x][] = ($thisMonthsActual) ? \App\formatCurrency($thisMonthsActual, true) : '';

                $thisYearsTotal += $thisMonthsActual;
            }

            $columnData[$x][] = \App\formatCurrency($thisYearsTotal, true);

            $x++;
        }

        $tData = new TableData();
        $tData->caption(__('recurring-expenses.recurring-expense-by-month', ['name' => $this->recurringExpense->name]))
            ->bordered(true)
            ->striped(true)
            ->highlightColumnHeaders(true)
            ->highlightRowHeaders(true)
            ->hoverable(true)
            ->responsive(true)
            ->addTableClass('text-right');

        $tData->setHeaders($columnLabels);

        for ($y = 0; $y < 13; $y++) {

            $row = [$rowLabels[$y]];

            for ($z = 0; $z < $x; $z++) {
                $row[] = $columnData[$z][$y];
            }

            $tData->addRow($row);
        }

        return $tData;
    }
}
