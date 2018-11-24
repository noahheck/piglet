<h2>{{ __('recurring-expenses.recurring-expenses') }}</h2>

<p>{!! nl2br(e(__('money-matters-welcome.recurring-expenses-details'))) !!}</p>

<hr>

<p>{!! nl2br(e(__('money-matters-welcome.recurring-expenses-prompt'))) !!}</p>

<p class="note">{!! nl2br(e(__('money-matters-welcome.recurring-expenses-prompt-note'))) !!}</p>



<hr style="width: 50%;">

<h3 class="text-center"><span class="fa fa-home"></span> {{ __('money-matters-welcome.recurring-expenses-housing') }}</h3>

<div class="row justify-content-center">

    @foreach ([
        'mortgage' => [
            'icon' => "home",
            'color' => "green",
        ],
        'rent'     => [
            'icon' => "home",
            'color' => "red",
        ],
        'hoa'      => [
            'icon' => "book",
            'color' => "purple",
        ],
    ] as $expense => $details)
        @include ('family.money-matters-welcome.recurring-expense', ['expense' => $expense, 'details' => $details])
    @endforeach

</div>



<hr style="width: 50%;">

<h3 class="text-center"><span class="fa fa-bolt"></span> {{ __('money-matters-welcome.recurring-expenses-utilities') }}</h3>

<div class="row justify-content-center">

    @foreach ([
        'electricity' => [
            'icon'  => "bolt",
            'color' => "#c7c769",
        ],
        'gas'         => [
            'icon'  => "fire",
            'color' => "red",
        ],
        'water'       => [
            'icon'  => "tint",
            'color' => "blue",
        ],
        'phone'       => [
            'icon'  => "phone",
            'color' => "green",
        ],
        'cable'       => [
            'icon'  => "television",
            'color' => "gray",
        ],
        'internet'    => [
            'icon'  => "globe",
            'color' => "#7777d2",
        ],
    ] as $expense => $details)
        @include ('family.money-matters-welcome.recurring-expense', ['expense' => $expense, 'details' => $details])
    @endforeach

</div>



<hr style="width: 50%;">

<h3 class="text-center"><span class="fa fa-car"></span> {{ __('money-matters-welcome.recurring-expenses-transportation') }}</h3>

<div class="row justify-content-center">

    @foreach ([
        'bus' => [
            'icon'  => "bus",
            'color' => "green",
        ],
        'car1' => [
            'icon'  => "car",
            'color' => "purple",
        ],
        'car2' => [
            'icon'  => "car",
            'color' => "purple",
        ],
    ] as $expense => $details)
        @include ('family.money-matters-welcome.recurring-expense', ['expense' => $expense, 'details' => $details,])
    @endforeach

</div>



<hr style="width: 50%;">

<h3 class="text-center"><span class="fa fa-dollar"></span> {{ __('money-matters-welcome.recurring-expenses-insurance') }}</h3>

<div class="row justify-content-center">

    @foreach ([
        'medical' => [
            'icon'  => "medkit",
            'color' => "green",
        ],
        'dental' => [
            'icon'  => "smile-o",
            'color' => "orange",
        ],
        'vision' => [
            'icon'  => "eye",
            'color' => "#7777d2",
        ],
        'life' => [
            'icon'  => "heartbeat",
            'color' => "red",
        ],
        'automobile' => [
            'icon'  => "car",
            'color' => "green",
        ],
    ] as $expense => $details)
        @include ('family.money-matters-welcome.recurring-expense', ['expense' => $expense, 'details' => $details,])
    @endforeach

</div>




<hr>

<p class="note">{!! nl2br(e(__('money-matters-welcome.recurring-expenses-review-note'))) !!}</p>

<p>{!! nl2br(e(__('money-matters-welcome.recurring-expenses-next'))) !!}</p>
