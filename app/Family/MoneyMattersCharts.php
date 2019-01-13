<?php

namespace App\Family;


use App\Interfaces\Definitions\Charts;
use Illuminate\Support\Collection;

use function App\formatCurrency;

class MoneyMattersCharts
{
    /**
     * @var Collection
     */
    private $cashFlowPlans;

    /**
     * @var Collection
     */
    private $categories;

    public function __construct($cashFlowPlans, $categories)
    {
        $this->cashFlowPlans = $cashFlowPlans;

        $this->categories    = $categories;
    }

    public function categoryTotalsChartData()
    {
        $labels = [];
        $colors = [];
        $data   = [];

        $cashFlowPlans = $this->cashFlowPlans;

        $this->categories->each(function($category) use (&$labels, &$colors, &$data, $cashFlowPlans) {

            $total = $cashFlowPlans->reduce(function($carry, $cfp) use ($category) {

                $recurringExpenseTotal = $cfp->recurringExpenses->where('category_id', $category->id)->sum('actual');
                $expenseTotal = $cfp->expenses->where('category_id', $category->id)->sum('actual');

                return $carry + $recurringExpenseTotal + $expenseTotal;
            }, 0);

            $labels[] = $category->name;
            $colors[] = $category->color;
            $data[]   = formatCurrency($total);

            /*$data[] = formatCurrency($cashFlowPlans->reduce(function($carry, $cfp) use ($category) {

                $recurringExpenseTotal = $cfp->recurringExpenses->where('category_id', $category->id)->sum('actual');
                $expenseTotal = $cfp->expenses->where('category_id', $category->id)->sum('actual');

                return $carry + $recurringExpenseTotal + $expenseTotal;
            }, 0));*/
        });

        return [
            'type' => 'pie',
            'options' => [
                'legend' => [
                    'position' => 'left',
                ],
            ],
            'data' => [
                'datasets' => [[
                    'data' => $data,
                    'backgroundColor' => $colors,
                ]],
                'labels' => $labels,
            ],
        ];
    }

    public function annualBalanceChartData()
    {
        $labels = [
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
        ];

        $data = [
            0 => [
                'label' => __('cash-flow-plans.income'),
                'backgroundColor' => Charts::BACKGROUND_COLOR_GRAY,
                'borderColor'     => Charts::BORDER_COLOR_GRAY,
            ],
            1 => [
                'label' => __('cash-flow-plans.overspent'),
                'backgroundColor' => Charts::BACKGROUND_COLOR_RED,
                'borderColor'     => Charts::BORDER_COLOR_RED,
            ],
            2 => [
                'label' => __('cash-flow-plans.expenditures'),
                'backgroundColor' => Charts::BACKGROUND_COLOR_BLUE,
                'borderColor'     => Charts::BORDER_COLOR_BLUE,
            ],
            3 => [
                'label' => __('cash-flow-plans.balance'),
                'backgroundColor' => Charts::BACKGROUND_COLOR_GREEN,
                'borderColor'     => Charts::BORDER_COLOR_GREEN,
            ],
        ];

        for ($x = 0; $x < 12; $x++) {

            /** @var CashFlowPlan $cfp */
            $cfp = $this->cashFlowPlans->where('month', $x + 1)->first();

            if (!$cfp) {
                $data[0]['data'][] = 0;
                $data[1]['data'][] = 0;
                $data[2]['data'][] = 0;
                $data[3]['data'][] = 0;

                continue;
            }

            $balance     = formatCurrency($cfp->balance());
            $isOverspent = $cfp->isOverspent();

            if ($isOverspent) {
                $data[0]['data'][] = formatCurrency($cfp->actualIncomeSourcesTotal());
                $data[1]['data'][] = abs($balance);
                $data[2]['data'][] = 0;
                $data[3]['data'][] = 0;
            } else {
                $data[0]['data'][] = 0;
                $data[1]['data'][] = 0;
                $data[2]['data'][] = formatCurrency($cfp->allExpendituresTotal());
                $data[3]['data'][] = $balance;
            }

        }


        return [
            'type' => 'bar',
            'options' => [
                'scales' => [
                    'xAxes' => [[
//                        'barPercentage' => '1.0',
                        'stacked' => true,
                    ]],
                    'yAxes' => [[
                        'stacked' =>true,
                        'ticks' => [
                            'min' => 0,
                        ],
                    ]],
                ],
            ],
            'data' => [
                'labels'   => $labels,
                'datasets' => $data,
            ],
        ];
    }
}
