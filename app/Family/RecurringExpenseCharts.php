<?php

namespace App\Family;

use App\Interfaces\Definitions\Charts;

class RecurringExpenseCharts
{
    /**
     * @var RecurringExpense
     */
    private $recurringExpense;

    public function __construct(RecurringExpense $recurringExpense)
    {
        $this->recurringExpense = $recurringExpense;
    }

    public function monthlyAmountsByYearChartData()
    {
        $colors = [
            [
                'backgroundColor' => Charts::BACKGROUND_COLOR_BLUE,
                'borderColor' => Charts::BORDER_COLOR_BLUE,
            ],
            [
                'backgroundColor' => Charts::BACKGROUND_COLOR_RED,
                'borderColor' => Charts::BORDER_COLOR_RED,
            ],
            [
                'backgroundColor' => Charts::BACKGROUND_COLOR_PURPLE,
                'borderColor' => Charts::BORDER_COLOR_PURPLE,
            ],
            [
                'backgroundColor' => Charts::BACKGROUND_COLOR_GREEN,
                'borderColor' => Charts::BORDER_COLOR_GREEN,
            ],
            [
                'backgroundColor' => Charts::BACKGROUND_COLOR_ORANGE,
                'borderColor' => Charts::BORDER_COLOR_ORANGE,
            ],
            [
                'backgroundColor' => Charts::BACKGROUND_COLOR_YELLOW,
                'borderColor' => Charts::BORDER_COLOR_YELLOW,
            ],
        ];

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

        $instances = $this->recurringExpense->recurringExpenseInstances;

        $instances = $instances->filter(function($instance, $key) {

            return optional($instance->cashFlowPlan)->id;
        });

        $cfps = $instances->pluck('cashFlowPlan');

        $years = $cfps->pluck('year')->unique()->sort();

        $data = [];

        $x = 0;

        foreach ($years as $year) {

            $dataset = [
                'label' => $year,
                'data' => [],
                'backgroundColor' => $colors[$x]['backgroundColor'],
                'borderColor' => $colors[$x]['borderColor'],
            ];

            $thisYearsCfps = $cfps->filter(function($cfp, $key) use ($year) {

                return $cfp->year === $year;
            });


            foreach (range(1, 12) as $month) {

                $thisMonthsCfp = $thisYearsCfps->firstWhere('month', $month);

                if (!$thisMonthsCfp) {
                    $dataset['data'][] = 0;

                    continue;
                }

                $thisMonthsInstance = $instances->firstWhere('cash_flow_plan_id', $thisMonthsCfp->id);

                $dataset['data'][] = ($thisMonthsInstance) ? $thisMonthsInstance->actual : 0;
            }

            $data[] = $dataset;
            $x++;
        }

        return [
            'type' => 'bar',
            'options' => [
                'scales' => [
                    'yAxes' => [[
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
