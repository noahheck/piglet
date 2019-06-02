@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) }} {{ $cashFlowPlan->year }} - {{ __('cash-flow-plans.lifestyle-expenses') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.cash-flow-plans.show.css') }}" />
@endpush

@push('scripts')
{{--    <script type="text/javascript" src="{{ mix('js/family.cash-flow-plans.show.js') }}"></script>--}}
@endpush


@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.cash-flow-plans.index', [$family]) => __('cash-flow-plans.cash-flow-plans'),
            route('family.cash-flow-plans.show', [$family, $cashFlowPlan]) => __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year,
        ],
        'location'   => __('cash-flow-plans.lifestyle-expenses'),
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('cash-flow-plans.lifestyle-expenses') }}</h2>

            <p class="small">* {{ __('cash-flow-plans.distributed-description') }}</p>

            <form class="has-bold-labels" name="lifestyle-expenses" action="{{ route('family.cash-flow-plans.lifestyle-expenses-update', [$family, $cashFlowPlan, 'return' => App\urlWithQueryString(url()->previous(), ['scroll' => 1])]) }}" method="POST">

                @csrf

                <hr style="width: 90%;">

                <div class="form-group">
                    <label for="pocket_money">{{ __('money-matters.pocket-money-label') }}</label>
                    <p>{{ __('money-matters.pocket-money-description') }}</p>
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                        </div>

                        <input type="text" name="pocket_money" id="pocket_money" class="form-control money-field" placeholder="{{ __('money-matters.pocket-money-label') }}" value="{{ old('pocket_money', App\formatCurrency($cashFlowPlan->pocket_money, false)) }}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <label for="pocket_money_distributed" style="margin: 0;">
                                    <input type="checkbox" name="pocket_money_distributed" id="pocket_money_distributed" value="1" {{ (old('pocket_money_distributed', $cashFlowPlan->pocket_money_distributed)) ? 'checked' : '' }}>
                                    {{ __('cash-flow-plans.distributed') }}
                                </label>
                            </div>
                        </div>

                    </div>
                    @fieldError('pocket_money')
                </div>

                <hr style="width: 90%;">

                <div class="form-group">
                    <label for="retirement">{{ __('money-matters.retirement-label') }}</label>
                    <p>{{ __('money-matters.retirement-description') }}</p>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                        </div>
                        <input type="text" name="retirement" id="retirement" class="form-control money-field" placeholder="{{ __('money-matters.retirement-label') }}" value="{{ old('retirement', App\formatCurrency($cashFlowPlan->retirement, false)) }}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <label for="retirement_distributed" style="margin: 0;">
                                    <input type="checkbox" name="retirement_distributed" id="retirement_distributed" value="1" {{ (old('retirement_distributed', $cashFlowPlan->retirement_distributed)) ? 'checked' : '' }}>
                                    {{ __('cash-flow-plans.distributed') }}
                                </label>
                            </div>
                        </div>

                    </div>
                    @fieldError('retirement')
                </div>

                <hr style="width: 90%;">

                <div class="form-group">
                    <label for="education">{{ __('money-matters.education-label') }}</label>
                    <p>{{ __('money-matters.education-description') }}</p>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                        </div>
                        <input type="text" name="education" id="education" class="form-control money-field" placeholder="{{ __('money-matters.education-label') }}" value="{{ old('education', App\formatCurrency($cashFlowPlan->education, false)) }}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <label for="education_distributed" style="margin: 0;">
                                    <input type="checkbox" name="education_distributed" id="education_distributed" value="1" {{ (old('education_distributed', $cashFlowPlan->education_distributed)) ? 'checked' : '' }}>
                                    {{ __('cash-flow-plans.distributed') }}
                                </label>
                            </div>
                        </div>

                    </div>
                    @fieldError('education')
                </div>

                <hr style="width: 90%;">

                <button type="submit" class="btn btn-primary">
                    {{ __('form.save') }}
                </button>

                <a class="btn btn-secondary" href="{{ App\urlWithQueryString(url()->previous(), ['scroll' => 1]) }}">
                    {{ __('form.cancel') }}
                </a>

            </form>

        </div>

    </div>

@endsection
