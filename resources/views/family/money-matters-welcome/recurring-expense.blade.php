{{--

--}}

<div class="col-12 col-sm-6 col-md-4 mb-4">

    <div class="card shadow">
        <div class="card-body">
            @if ($details['icon'])
                <div class="text-center">
                    {{--<span class="circle-icon" style="color: #fff; background-color: {{ $details['color'] }};">
                        {!! $details['icon'] !!}
                    </span>--}}
                    <span class="fa-stack fa-3x">
                        <span class="fa fa-circle fa-stack-2x" style="color: {{ $details['color'] }};"></span>
                        <span class="fa fa-{{ $details['icon'] }} fa-stack-1x color-white"></span>
                    </span>
                </div>
            @endif
            <h4 class="text-center">
                {{ __('money-matters-welcome.recurring-expenses-' . $expense) }}
            </h4>

            <label for="recurring_expenses_{{ $expense }}_merchant">{{ __('merchants.merchant') }}</label>

            <input type="text" class="form-control" name="recurring_expenses_{{ $expense }}_merchant" id="recurring_expenses_{{ $expense }}_merchant" placeholder="{{ __('merchants.merchant') }}">

            <label for="recurring_expenses_mortgage_amount">{{ __('cash-flow-plans.amount') }}</label>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                    </div>
                    <input type="text" name="recurring_expenses_{{ $expense }}_amount" id="recurring_expenses_{{ $expense }}_amount" class="form-control money-field" placeholder="{{ __('income-sources.default-amount') }}"">
                </div>
            </div>

        </div>
    </div>

</div>
