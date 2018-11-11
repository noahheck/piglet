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
            'icon' => "<span class='fa fa-home'></span>",
            'color' => "green",
        ],
        'rent'     => [
            'icon' => "<span class='fa fa-home'></span>",
            'color' => "red",
        ],
        'hoa'      => [
            'icon' => "<span class='fa fa-book'></span>",
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
            'icon'  => "<span class='fa fa-bolt'></span>",
            'color' => "#c7c769",
        ],
        'gas'         => [
            'icon'  => "<span class='fa fa-fire'></span>",
            'color' => "red",
        ],
        'water'       => [
            'icon'  => "<span class='fa fa-tint'></span>",
            'color' => "blue",
        ],
        'phone'       => [
            'icon'  => "<span class='fa fa-phone'></span>",
            'color' => "green",
        ],
        'cable'       => [
            'icon'  => "<span class='fa fa-television'></span>",
            'color' => "gray",
        ],
        'internet'    => [
            'icon'  => "<span class='fa fa-globe'></span>",
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
            'icon'  => "<span class='fa fa-bus'></span>",
            'color' => "green",
        ],
        'car1' => [
            'icon'  => "<span class='fa fa-car'></span>",
            'color' => "purple",
        ],
        'car2' => [
            'icon'  => "<span class='fa fa-car'></span>",
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
            'icon'  => "<span class='fa fa-medkit'></span>",
            'color' => "green",
        ],
        'dental' => [
            'icon'  => "<span class='fa fa-smile-o'></span>",
            'color' => "orange",
        ],
        'vision' => [
            'icon'  => "<span class='fa fa-eye'></span>",
            'color' => "#7777d2",
        ],
        'life' => [
            'icon'  => "<span class='fa fa-heartbeat'></span>",
            'color' => "red",
        ],
        'automobile' => [
            'icon'  => "<span class='fa fa-car'></span>",
            'color' => "green",
        ],
    ] as $expense => $details)
        @include ('family.money-matters-welcome.recurring-expense', ['expense' => $expense, 'details' => $details,])
    @endforeach

</div>




<hr>

<p class="note">{!! nl2br(e(__('money-matters-welcome.recurring-expenses-review-note'))) !!}</p>

<p>{!! nl2br(e(__('money-matters-welcome.recurring-expenses-next'))) !!}</p>
