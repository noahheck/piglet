<h1>{{ __('money-matters.welcome!') }}</h1>

<p>{!! nl2br(e(__('money-matters-welcome.introduction'))) !!}</p>

<p>{!! nl2br(e(__('money-matters-welcome.wizard-process'))) !!}</p>

<hr style="width: 50%;">

<div class="row introduction">
    <div class="col-12 col-sm-7 order-sm-2">
        <h3>{{ __('money-matters-welcome.navigation') }}</h3>
        <p>{!! nl2br(e(__('money-matters-welcome.navigation-details'))) !!}</p>
    </div>
    <div class="col-12 col-sm-5 text-center order-sm-1">
        <img src="{{ asset("img/money-matters-welcome/navigation_menu.png") }}" class="img-fluid" alt="{{ __('money-matters-welcome.navigation') }}">
    </div>
</div>

<div class="row introduction mt-5 border shadow">
    <div class="col-12 col-sm-7">
        <h3>{{ __('money-matters-welcome.overview') }}</h3>
        <p>{!! nl2br(e(__('money-matters-welcome.overview-details'))) !!}</p>
    </div>
    <div class="col-12 col-sm-5 text-center">
        <img src="{{ asset("img/money-matters-welcome/overview.png") }}" class="img-fluid" alt="{{ __('money-matters-welcome.overview') }}">
    </div>
</div>

<div class="row introduction mt-5">
    <div class="col-12 col-sm-7 order-sm-2">
        <h3>{{ __('cash-flow-plans.cash-flow-plans') }}</h3>
        <p>{!! nl2br(e(__('money-matters-welcome.cash-flow-plans-details'))) !!}</p>
    </div>
    <div class="col-12 col-sm-5 text-center order-sm-1">
        <img src="{{ asset("img/money-matters-welcome/cash_flow_plans.png") }}" class="img-fluid" alt="{{ __('cash-flow-plans.cash-flow-plans') }}">
    </div>
</div>

<div class="row introduction mt-5 border shadow">
    <div class="col-12 col-sm-8">
        <h3>{{ __('merchants.merchants') }}</h3>
        <p>{!! nl2br(e(__('money-matters-welcome.merchant-details'))) !!}</p>
    </div>
    <div class="col-12 col-sm-4 text-center">
        <img src="{{ asset("img/money-matters-welcome/merchant.png") }}" class="img-fluid" alt="{{ __('merchants.merchant') }}">
    </div>
</div>

<div class="row introduction mt-5">
    <div class="col-12 col-sm-8 order-sm-2">
        <h3>{{ __('piggy-banks.piggy-banks') }}</h3>
        <p>{!! nl2br(e(__('money-matters-welcome.piggy-bank-details'))) !!}</p>
    </div>
    <div class="col-12 col-sm-4 text-center order-sm-1">
        <img src="{{ asset("img/money-matters-welcome/piggy_banks.png") }}" class="img-fluid" alt="{{ __('piggy-banks.piggy-banks') }}">
    </div>
</div>
