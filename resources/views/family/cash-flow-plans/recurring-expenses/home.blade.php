@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('recurring-expenses.recurring-expenses') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family.categories.index.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ asset('js/family.cash-flow-plans.income-sources.index.js') }}"></script>--}}
@endpush


@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.cash-flow-plans.index', [$family]) => __('cash-flow-plans.cash-flow-plans'),
            route('family.cash-flow-plans.show', [$family, $cashFlowPlan]) => __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year,
        ],
        'location'   => __('recurring-expenses.recurring-expenses'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.cash-flow-plans.recurring-expenses.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('recurring-expenses.add-new-recurring-expense')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} {{ __('recurring-expenses.recurring-expenses') }}</h2>

            @if ($cashFlowPlan->recurringExpenses->count() === 0)

                {{ __('recurring-expenses.no-recurring-expenses-create') }}
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.cash-flow-plans.recurring-expenses.create', [$family, $cashFlowPlan]) }}">
                        <span class="fa fa-plus-circle"></span>
                        {{ __('recurring-expenses.add-new-recurring-expense') }}
                    </a>
                </p>

            @else

                <table class="table table-sm">
                    <caption>{{ __('cash-flow-plans.actual') }} {{ __('recurring-expenses.recurring-expenses') }}</caption>
                    <thead>
                    <tr>
                        <td class="text-center">Name</td>
                        <td class="text-right">Projected</td>
                        <td class="text-right">Actual</td>
                    </tr>
                    </thead>
                    @foreach ($cashFlowPlan->recurringExpenses as $recurringExpense)
                        <tr>
                            <td><a href="{{ route('family.cash-flow-plans.recurring-expenses.edit', [$family, $cashFlowPlan, $recurringExpense]) }}">{{ $recurringExpense->name }}</a></td>
                            <td class="text-right">{{ Auth::user()->formatCurrency($recurringExpense->projected, true) }}</td>
                            <td class="text-right">{{ Auth::user()->formatCurrency($recurringExpense->actual, true) }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                        <td class="text-right"><strong>{{ Auth::user()->formatCurrency($cashFlowPlan->projectedRecurringExpensesTotal(), true) }}</strong></td>
                        <td class="text-right"><strong>{{ Auth::user()->formatCurrency($cashFlowPlan->actualRecurringExpensesTotal(), true) }}</strong></td>
                    </tr>
                </table>

        </div>

            @endif

            {{--<ul class="nav nav-tabs" id="budgetTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="budgetTab" data-toggle="tab" href="#budget" role="tab" aria-controls="budget" aria-selected="true">{{ __('cash-flow-plans.budget') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="actualTab" data-toggle="tab" href="#actual" role="tab" aria-controls="actual" aria-selected="false">{{ __('cash-flow-plans.actual') }}</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="budget" role="tabpanel" aria-labelledby="budgetTab">

                    <div class="row justify-content-center mt-3">

                        <div class="col-12 col-md-10 col-lg-8 col-xl-6">

                            @if ($cashFlowPlan->recurringExpenses->where('type', 'budget')->count() === 0)

                                {{ __('recurring-expenses.no-recurring-expenses-create') }}
                                <p class="text-center">
                                    <a class="btn btn-primary" href="{{ route('family.cash-flow-plans.recurring-expenses.create', [$family, $cashFlowPlan]) }}">
                                        <span class="fa fa-plus-circle"></span>
                                        {{ __('recurring-expenses.add-new-recurring-expense') }}
                                    </a>
                                </p>

                            @else

                                <ul class="list-group shadow income-sources" id="budgeted-income-sources">
                                    @foreach ($cashFlowPlan->recurringExpenses->where('type', 'budget') as $expense)
                                        <li class="list-group-item">
                                            <a href="{{ route('family.cash-flow-plans.recurring-expenses.edit', [$family, $cashFlowPlan, $expense]) }}">
                                                {{ $expense->name }} - {{ Auth::user()->formatCurrency($expense->amount, true) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                <hr>

                                <h5>{{ __('cash-flow-plans.total') }}: {{ Auth::user()->formatCurrency($cashFlowPlan->recurringExpenses->where('type', 'budget')->sum('amount'), true) }}</h5>

                            @endif


                        </div>

                    </div>

                </div>


                <div class="tab-pane fade" id="actual" role="tabpanel" aria-labelledby="actualTab">

                    <div class="row justify-content-center mt-3">

                        <div class="col-12 col-md-10 col-lg-8 col-xl-6">

                            @if ($cashFlowPlan->recurringExpenses->where('type', 'actual')->count() === 0)

                                {{ __('recurring-expenses.no-recurring-expenses-create') }}
                                <p class="text-center">
                                    <a class="btn btn-primary" href="{{ route('family.cash-flow-plans.recurring-expenses.create', [$family, $cashFlowPlan]) }}">
                                        <span class="fa fa-plus-circle"></span>
                                        {{ __('recurring-expenses.add-new-recurring-expense') }}
                                    </a>
                                </p>

                            @else

                                <ul class="list-group shadow income-sources" id="budgeted-income-sources">
                                    @foreach ($cashFlowPlan->recurringExpenses->where('type', 'actual') as $expense)
                                        <li class="list-group-item">
                                            <a href="{{ route('family.cash-flow-plans.recurring-expenses.edit', [$family, $cashFlowPlan, $expense]) }}">
                                                {{ $expense->name }} - {{ Auth::user()->formatCurrency($expense->amount, true) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                <hr>

                                <h5>{{ __('cash-flow-plans.total') }}: {{ Auth::user()->formatCurrency($cashFlowPlan->recurringExpenses->where('type', 'actual')->sum('amount'), true) }}</h5>

                            @endif

                        </div>

                    </div>

                </div>

            </div>--}}

        </div>

    </div>

@endsection
