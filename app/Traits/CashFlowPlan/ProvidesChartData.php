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
                    __('income-sources.income-sources')         . ' - ' . formatCurrency($this->actualIncomeSourcesTotal(), true),
                    __('cash-flow-plans.lifestyle-expenses')    . ' - ' . formatCurrency($this->distributedLifestyleExpensesTotal(), true),
                    __('piggy-banks.piggy-banks')               . ' - ' . formatCurrency($this->actualPiggyBankContributionsTotal(), true),
                    __('recurring-expenses.recurring-expenses') . ' - ' . formatCurrency($this->actualRecurringExpensesTotal(), true),
                    __('expenses.expenses')                     . ' - ' . formatCurrency($this->actualExpensesTotal(), true),
                ],
                'datasets' => [
                    [
                        'label' => __('cash-flow-plans.projected'),
                        'data' => [
                            formatCurrency($this->projectedIncomeSourcesTotal()),
                            formatCurrency($this->projectedLifestyleExpensesTotal()),
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
                            formatCurrency($this->actualIncomeSourcesTotal()),
                            formatCurrency($this->distributedLifestyleExpensesTotal()),
                            formatCurrency($this->actualPiggyBankContributionsTotal()),
                            formatCurrency($this->actualRecurringExpensesTotal()),
                            formatCurrency($this->actualExpensesTotal()),
                        ],
                        'backgroundColor' => [
                            Charts::BACKGROUND_COLOR_GREEN,
                            Charts::BACKGROUND_COLOR_GREEN,
                            Charts::BACKGROUND_COLOR_GREEN,
                            ($this->recurringExpensesOverspent()) ? Charts::BACKGROUND_COLOR_RED : Charts::BACKGROUND_COLOR_GREEN,
                            ($this->expenseGroupsOverspent()) ? Charts::BACKGROUND_COLOR_RED : Charts::BACKGROUND_COLOR_GREEN,
                        ],
                        'borderColor' => [
//                            Charts::BORDER_COLOR_BLUE,
                            Charts::BORDER_COLOR_GREEN,
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



    public function projectedBalanceChartData($showLegend = true)
    {
        return $this->balanceChartData(
            $this->projectedBalance(),
            $this->allProjectedExpendituresTotal(),
            $this->projectedIncomeSourcesTotal(),
            $showLegend
        );
    }

    public function actualBalanceChartData($showLegend = true)
    {
        return $this->balanceChartData(
            $this->balance(),
            $this->allExpendituresTotal(),
            $this->actualIncomeSourcesTotal(),
            $showLegend
        );
    }

    protected function balanceChartData($balance, $expendituresTotal, $incomeSourcesTotal, $showLegend)
    {

        if ($balance >= 0) {
            // Not overspent

            $firstPortion  = $expendituresTotal;
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

            $firstPortion  = $incomeSourcesTotal;
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
                'legend' => [
                    'display' => $showLegend,
                ],
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