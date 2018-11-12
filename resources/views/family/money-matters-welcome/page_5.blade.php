<h2>{{ __('expense-groups.expense-groups') }}</h2>

<p>{!! nl2br(e(__('money-matters-welcome.expense-groups-details'))) !!}</p>

<hr>

<p>{!! nl2br(e(__('money-matters-welcome.expense-groups-prompt'))) !!}</p>

<hr style="width: 50%;">

@foreach ([
    'food' => [
        'icon'  => "<span class='fa fa-apple'></span>",
        'color' => 'red',
        'merchantTypes' => [
            'grocer' => [
                'icon' => "<span class='fa fa-shopping-cart'></span>",
            ],
            'restaurant' => [
                'icon' => "<span class='fa fa-cutlery'></span>",
            ],
        ],
    ],
    'gas' => [
        'icon'  => "<span class='fa fa-road'></span>",
        'color' => "orange",
        'merchantTypes' => [
            'gasstation' => [
                'icon' => "<span class='fa fa-tachometer'></span>"
            ],
        ],
    ],
    'household' => [
        'icon'  => "<span class='fa fa-home'></span>",
        'color' => "green",
        'merchantTypes' => [
            'householdsupplier' => [
                'icon' => "<span class='fa fa-road'></span>"
            ],
        ],
    ],
] as $expense => $details)

    @include ('family.money-matters-welcome.expense-group', [
        'expense'       => $expense,
        'icon'          => $details['icon'],
        'iconColor'     => $details['color'],
        'merchantTypes' => $details['merchantTypes']
    ])

<hr style="width: 50%;">

@endforeach

<div class="row justify-content-center">

    <div class="col-12 col-sm-6">

        <div class="card shadow">
            <div class="card-body">
                <div class="text-center">
                    <span class="circle-icon" style="color: #fff; background-color: purple;">
                        <span class="fa fa-question-circle-o"></span>
                    </span>
                </div>

                <h4 class="text-center">
                    {{ __('money-matters-welcome.expense-groups-stuff') }}
                </h4>
                <label for="expense_groups_stuff_amount">{{ __('cash-flow-plans.amount') }}</label>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                        </div>
                        <input type="text" name="expense_groups_stuff_amount" id="expense_groups_stuff_amount" class="form-control money-field" placeholder="{{ __('cash-flow-plans.amount') }}"">
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<hr>

<p class="note">{!! nl2br(e(__('money-matters-welcome.expense-groups-review-note'))) !!}</p>

<p>{!! nl2br(e(__('money-matters-welcome.expense-groups-next'))) !!}</p>
