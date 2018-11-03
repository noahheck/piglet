<?php

namespace App\Family;

use App\Interfaces\Definitions\Charts;
use App\Traits\HasDueDate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class PiggyBank extends Model
{
    use SoftDeletes,
        HasDueDate
    ;

    protected $fillable = [
        'name',
        'starting_amount',
        'target_amount',
        'monthly_contribution',
        'description',
        'dueDate',
        'active',
        'completed',
    ];

    protected $casts = [
        'active'    => 'boolean',
        'completed' => 'boolean',
    ];

    public static function getValidations()
    {
        return [
            'name'                 => 'required|max:255',
            'dueDate'              => 'date|nullable',
            'target_amount'        => 'numeric|nullable',
            'starting_amount'      => 'numeric|nullable',
            'monthly_contribution' => 'numeric|nullable',
        ];
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'dueDate',
    ];

    public function getBalanceAttribute()
    {
        return $this->starting_amount + $this->contributionsTotal();
    }

    public function getPercentCompletedAttribute()
    {
        if (!$this->target_amount) {
            return null;
        }

        return ($this->balance / $this->target_amount) * 100;
    }


    public function contributionsTotal()
    {
        return $this->monthlyPiggyBanks->reduce(function($total, $piggyBank) {
            return $total + $piggyBank->actualTotal();
        }, 0);
    }

    public function allContributions()
    {
        $contributions = collect([]);

        $this->monthlyPiggyBanks->each(function($piggyBank, $key) use ($contributions) {
            $contributions->push($piggyBank->contributions);
        });

        return $contributions->flatten()->sortBy('date');
    }


    public function monthlyPiggyBanks()
    {
        return $this->hasMany(\App\Family\CashFlowPlan\PiggyBank::class);
    }












    public function growthChartData()
    {
        $monthFormat = "M 'y";

        $created = $this->created_at;

        $start = $this->monthlyPiggyBanks->reduce(function ($earliest, $piggyBank) {
            $cfpDate = $piggyBank->cashFlowPlan->monthAsDateTime();

            return ($earliest && $earliest < $cfpDate) ? $earliest : $cfpDate;
        });


        $start = ($start < $created) ? $start : $created;

        $end = new Carbon();

        if ($this->completed) {

            $end = $this->monthlyPiggyBanks->reduce(function ($latest, $piggyBank) {
                $cfpDate = $piggyBank->cashFlowPlan->monthAsDateTime();

                return ($latest < $cfpDate) ? $cfpDate : $latest;
            });

        }

        $interval = \DateInterval::createFromDateString('1 month');
        $period   = new \DatePeriod($start, $interval, $end);

        // The names of the months to display at the bottom of the chart
        $monthLabels        = [];
        // The contributions to the piggy bank in each month
        $monthContributions = [];

        foreach ($period as $monthDt) {
            $monthString   = $monthDt->format($monthFormat);
            $monthLabels[] = $monthString;

            $monthContributions[$monthString] = 0;
        }

        reset($monthContributions);
        $firstKey = key($monthContributions);
        reset($monthContributions);

        $monthContributions[$firstKey] = $this->starting_amount;

        $this->monthlyPiggyBanks->each(function ($piggyBank, $key) use (&$monthContributions, $monthFormat) {
            $cfpDateString = $piggyBank->cashFlowPlan->monthAsDateTime()->format($monthFormat);

            $monthContributions[$cfpDateString] += $piggyBank->actualTotal();
        });



        $values = [];

        foreach ($monthContributions as $month => $contributions) {
            $values[] = $contributions + end($values);
        }

        return [
            'type'    => 'line',
            'options' => [
                'scales' => [
                    'yAxes' => [[
                        'ticks' => [
                            'min' => 0,
                            'suggestedMax' => ($this->target_amount) ? 0 + $this->target_amount : 0,
                        ],
                    ]]
                ],
                'elements' => [
                    'line' => [
                        'tension' => 0,
                    ],
                ],
            ],
            'data' => [
                'labels' => $monthLabels,
                'datasets' => [[
                    'label' => __('piggy-banks.balance'),
                    'data' => $values,
                    'backgroundColor' => Charts::BACKGROUND_COLOR_BLUE,
                    'borderColor'     => Charts::BORDER_COLOR_BLUE,
                    'borderWidth'     => '0.5',
                ]],
            ],
        ];
    }
}
