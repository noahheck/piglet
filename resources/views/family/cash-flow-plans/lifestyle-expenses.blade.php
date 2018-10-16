@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) }} {{ $cashFlowPlan->year }} - {{ __('cash-flow-plans.lifestyle-expenses') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.cash-flow-plans.show.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.cash-flow-plans.show.js') }}"></script>
@endpush


@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.cash-flow-plans.index', [$family]) => __('cash-flow-plans.cash-flow-plans'),
            route('family.cash-flow-plans.show', [$family, $cashFlowPlan]) => __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year,
        ],
        'location'   => __('cash-flow-plans.lifestyle-expenses'),
        /*'menu' => [
            ['type' => 'link', 'href' => route('family.cash-flow-plans.income-sources.create', [$family, $cashFlowPlan, 'return' => url()->current()]), 'icon' => 'fa fa-money', 'text' => __('income-sources.add-new-income-source')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.recurring-expenses.create', [$family, $cashFlowPlan, 'return' => url()->current()]), 'icon' => 'fa fa-refresh', 'text' => __('recurring-expenses.add-new-recurring-expense')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.expense-groups.create', [$family, $cashFlowPlan, 'return' => url()->current()]), 'icon' => 'fa fa-folder-open-o', 'text' => __('expense-groups.add-new-expense-group')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.expenses.create', [$family, $cashFlowPlan, 'return' => url()->current()]), 'icon' => 'fa fa-dollar', 'text' => __('expenses.add-new-expense')],
        ]*/
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('cash-flow-plans.lifestyle-expenses') }}</h2>

            <form class="has-bold-labels" name="lifestyle-expenses" action="{{ route('family.cash-flow-plans.lifestyle-expenses-update', [$family, $cashFlowPlan, 'return' => url()->previous()]) }}" method="POST">

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
                    </div>
                    @fieldError('education')
                </div>

                <hr style="width: 90%;">

                <button type="submit" class="btn btn-primary">
                    {{ __('form.save') }}
                </button>

                <a class="btn btn-secondary" href="{{ url()->previous() }}">
                    {{ __('form.cancel') }}
                </a>

            </form>

        </div>

    </div>

@endsection
