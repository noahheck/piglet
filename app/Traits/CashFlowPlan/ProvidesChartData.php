<?php

namespace App\Traits\CashFlowPlan;


use App\Interfaces\Definitions\Charts;

use function App\formatCurrency;

trait ProvidesChartData
{
    public function summaryChartData()
    {
        return [
            'type' => 'horizontalBar',
            'options' => [
                'scales' => [
                    'yAxes' => [[
                        'barPercentage' => '1.0',
                    ]],
                    'xAxes' => [[
                        'ticks' => [
                            'min' => 0,
                        ],
                    ]]
                ],
            ],
            'data' => [
                'labels' => [
//                    __('cash-flow-plans.income')                . ' - ' . formatCurrency($this->actualIncomeSourcesTotal(), true),
                    __('cash-flow-plans.lifestyle-expenses')    . ' - ' . formatCurrency($this->lifestyleExpensesTotal(), true),
                    __('piggy-banks.piggy-banks')               . ' - ' . formatCurrency($this->actualPiggyBankContributionsTotal(), true),
                    __('recurring-expenses.recurring-expenses') . ' - ' . formatCurrency($this->actualRecurringExpensesTotal(), true),
                    __('expenses.expenses')                     . ' - ' . formatCurrency($this->actualExpensesTotal(), true),
                ],
                'datasets' => [
                    [
                        'label' => __('cash-flow-plans.projected'),
                        'data' => [
//                            formatCurrency($this->projectedIncomeSourcesTotal()),
                            formatCurrency($this->lifestyleExpensesTotal()),
                            formatCurrency($this->projectedPiggyBankTotal()),
                            formatCurrency($this->projectedRecurringExpensesTotal()),
                            formatCurrency($this->expenseGroupsProjectedTotal()),
                        ],
                        'backgroundColor' => Charts::BACKGROUND_COLOR_GRAY,
                        'borderColor'     => Charts::BORDER_COLOR_GRAY,
                        'borderWidth'     => '0.5',
                    ],
                    [
                        'label' => __('cash-flow-plans.actual'),
                        'data'  => [
//                            formatCurrency($this->actualIncomeSourcesTotal()),
                            formatCurrency($this->lifestyleExpensesTotal()),
                            formatCurrency($this->actualPiggyBankContributionsTotal()),
                            formatCurrency($this->actualRecurringExpensesTotal()),
                            formatCurrency($this->actualExpensesTotal()),
                        ],
                        'backgroundColor' => [
//                            Charts::BACKGROUND_COLOR_BLUE,
                            Charts::BACKGROUND_COLOR_GREEN,
                            Charts::BACKGROUND_COLOR_GREEN,
                            ($this->recurringExpensesOverspent()) ? Charts::BACKGROUND_COLOR_RED : Charts::BACKGROUND_COLOR_GREEN,
                            ($this->expenseGroupsOverspent()) ? Charts::BACKGROUND_COLOR_RED : Charts::BACKGROUND_COLOR_GREEN,
                        ],
                        'borderColor' => [
//                            Charts::BORDER_COLOR_BLUE,
                            Charts::BORDER_COLOR_GREEN,
                            Charts::BORDER_COLOR_GREEN,
                            ($this->recurringExpensesOverspent()) ? Charts::BORDER_COLOR_RED : Charts::BORDER_COLOR_GREEN,
                            ($this->expenseGroupsOverspent()) ? Charts::BORDER_COLOR_RED : Charts::BORDER_COLOR_GREEN,
                        ],
                        'borderWidth' => '0.5',
                    ],
                ],
            ],
        ];
    }

    public function balanceChartData()
    {
        $balance = $this->balance();

        if ($balance > 0) {
            // Not overspent

            $firstPortion  = $this->allExpendituresTotal();
            $secondPortion = $balance;

            $firstPortionColor  = Charts::BACKGROUND_COLOR_BLUE;
            $firstPortionBorder = Charts::BORDER_COLOR_BLUE;

            $secondPortionColor  = Charts::BACKGROUND_COLOR_GRAY;
            $secondPortionBorder = Charts::BORDER_COLOR_GRAY;

            $firstPortionLabel  = __('cash-flow-plans.expenditures');
            $secondPortionLabel = __('cash-flow-plans.balance');

            $title = __('cash-flow-plans.balance') . ': ' . formatCurrency($secondPortion, true);

        } else {
            // Overspent

            $firstPortion  = $this->actualIncomeSourcesTotal();
            $secondPortion = abs($balance);

            $firstPortionColor  = Charts::BACKGROUND_COLOR_GRAY;
            $firstPortionBorder = Charts::BORDER_COLOR_GRAY;

            $secondPortionColor  = Charts::BACKGROUND_COLOR_RED;
            $secondPortionBorder = Charts::BORDER_COLOR_RED;

            $firstPortionLabel  = __('cash-flow-plans.income');
            $secondPortionLabel = __('cash-flow-plans.overspent');

            $title = __('cash-flow-plans.overspent') . ': ' . formatCurrency($secondPortion, true);
        }

        $firstPortion  = formatCurrency($firstPortion);
        $secondPortion = formatCurrency($secondPortion);

        return [
            'type' => 'doughnut',
            'options' => [
                'rotation'      => 3.14159,
                'circumference' => 3.14159,
                'title' => [
                    'display'  => true,
                    'position' => 'bottom',
                    'text'     => $title,
                ]
            ],
            'data' => [
                'datasets' => [
                    [
                        'data'            => [$firstPortion, $secondPortion],
                        'backgroundColor' => [$firstPortionColor, $secondPortionColor],
                        'borderColor'     => [$firstPortionBorder, $secondPortionBorder],
                        'borderWidth'     => [0.5, 0.5],
                    ],
                ],
                'labels' => [$firstPortionLabel, $secondPortionLabel],
            ],
        ];
    }
}