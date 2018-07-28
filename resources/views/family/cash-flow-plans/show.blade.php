@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Cash Flow Plans - {{ __('months.' . $cashFlowPlan->month) }} {{ $cashFlowPlan->year }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.cash-flow-plans.show.css') }}" />
@endpush

@push('scripts')
{{--    <script type="text/javascript" src="{{ asset('js/family.categories.index.js') }}"></script>--}}
@endpush


@php

$months = [
    '01' => 'January',
    '02' => 'February',
    '03' => 'March',
    '04' => 'April',
    '05' => 'May',
    '06' => 'June',
    '07' => 'July',
    '08' => 'August',
    '09' => 'September',
    '10' => 'October',
    '11' => 'November',
    '12' => 'December',
];

@endphp


@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.cash-flow-plans.index', [$family]) => 'Cash Flow Plans',
        ],
        'location'   => __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year,
    ])
        {{--'menu' => [
            ['type' => 'link', 'href' => route('family.categories.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('categories.add-new-category')],
        ]--}}

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('months.' . $cashFlowPlan->month) }} {{ $cashFlowPlan->year }}</h2>

            <ul class="nav nav-tabs" id="budgetTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="overviewTab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="budgetTab" data-toggle="tab" href="#budget" role="tab" aria-controls="budget" aria-selected="false">Budget</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="actualTab" data-toggle="tab" href="#actual" role="tab" aria-controls="actual" aria-selected="false">Actual</a>
                </li>
            </ul>


            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overviewTab">
                    Overview
                </div>


                <div class="tab-pane fade" id="budget" role="tabpanel" aria-labelledby="budgetTab">

                    <div id="budget_incomeSources" class="section budget-section">

                        <h3>
                            <a href="{{ route('family.cash-flow-plans.income-sources.index', [$family, $cashFlowPlan]) }}#budget">{{ __('income-sources.income-sources') }}</a>
                        </h3>

                        <table class="table table-sm">
                            <caption>{{ __('cash-flow-plans.budget') }} {{ __('income-sources.income-sources') }}</caption>
                            @foreach ($cashFlowPlan->incomeSources->where('type', 'budget') as $incomeSource)
                                <tr>
                                    <td>{{ $incomeSource->name }}</td>
                                    <td class="text-right">{{ Auth::user()->formatCurrency($incomeSource->amount, true) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                                <td class="text-right"><strong>{{ Auth::user()->formatCurrency($cashFlowPlan->budgetIncomeSourcesTotal(), true) }}</strong></td>
                            </tr>
                        </table>

                    </div>

                    <div id="budget_recurringExpenses" class="section budget-section">
                        <h3>
                            <a href="{{ route('family.cash-flow-plans.recurring-expenses.index', [$family, $cashFlowPlan]) }}">Recurring Expenses</a>
                        </h3>



                    </div>

                </div>


                <div class="tab-pane fade" id="actual" role="tabpanel" aria-labelledby="actualTab">

                    <div id="budget_incomeSources" class="section actual-section">

                        <h3>
                            <a href="{{ route('family.cash-flow-plans.income-sources.index', [$family, $cashFlowPlan]) }}#actual">{{ __('income-sources.income-sources') }}</a>
                        </h3>

                        <table class="table table-sm">
                            <caption>{{ __('cash-flow-plans.actual') }} {{ __('income-sources.income-sources') }}</caption>
                            @foreach ($cashFlowPlan->incomeSources->where('type', 'actual') as $incomeSource)
                                <tr>
                                    <td>{{ $incomeSource->name }}</td>
                                    <td class="text-right">{{ Auth::user()->formatCurrency($incomeSource->amount, true) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                                <td class="text-right"><strong>{{ Auth::user()->formatCurrency($cashFlowPlan->actualIncomeSourcesTotal(), true) }}</strong></td>
                            </tr>
                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
