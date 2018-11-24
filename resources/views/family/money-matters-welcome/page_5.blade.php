<h2>{{ __('expense-groups.expense-groups') }}</h2>

<p>{!! nl2br(e(__('money-matters-welcome.expense-groups-details'))) !!}</p>

<hr>

<p>{!! nl2br(e(__('money-matters-welcome.expense-groups-prompt'))) !!}</p>

<hr style="width: 50%;">

@foreach ([
    'food' => [
        'icon'  => "shopping-basket",
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
        'icon'  => "road",
        'color' => "orange",
        'merchantTypes' => [
            'gasstation' => [
                'icon' => "<span class='fa fa-tachometer'></span>"
            ],
        ],
    ],
    'household' => [
        'icon'  => "home",
        'color' => "green",
        'merchantTypes' => [
            'householdsupplier' => [
                'icon' => "<span class='fa fa-home'></span>"
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

    <div class="col-12 col-sm-8 col-md-6">

        <div class="card shadow">
            <div class="card-body">

                <h4 class="text-center">
                    {{ __('money-matters-welcome.expense-groups-stuff') }}
                </h4>
                <div class="text-center">
                    <span class="fa-stack fa-3x">
                        <span class="fa fa-circle fa-stack-2x color-purple"></span>
                        <span class="fa fa-question-circle-o fa-stack-1x color-white"></span>
                    </span>
                </div>

                <p class="text-center">{{ __('money-matters-welcome.expense-groups-stuff-details') }}</p>

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
