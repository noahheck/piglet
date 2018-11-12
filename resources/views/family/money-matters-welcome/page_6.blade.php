<h2>{{ __('piggy-banks.piggy-banks') }}</h2>

<p>{!! nl2br(e(__('money-matters-welcome.piggy-banks-details'))) !!}</p>

<hr>

<p>{!! nl2br(e(__('money-matters-welcome.piggy-banks-prompt'))) !!}</p>

@foreach ([
    '1' => 'green',
    '2' => 'blue',
    '3' => 'purple',
] as $piggyBank => $color)
    @include ("family.money-matters-welcome.piggy-bank", ['piggyBank' => $piggyBank])
@endforeach


