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
                    <a class="nav-link" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Details</a>
                </li>
            </ul>


            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overviewTab">
                    Overview
                </div>



                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="detailsTab">

                    <div id="incomeSources" class="section">

                        <h3>
                            <a href="{{ route('family.cash-flow-plans.income-sources.index', [$family, $cashFlowPlan]) }}">{{ __('income-sources.income-sources') }}</a>
                        </h3>

                        <table class="table table-sm">
                            <caption>{{ __('income-sources.income-sources') }}</caption>
                            <thead>
                                <tr class="font-weight-bold">
                                    <td class="text-center">Name</td>
                                    <td class="text-right">Projected</td>
                                    <td class="text-right">Actual</td>
                                </tr>
                            </thead>
                            @foreach ($cashFlowPlan->incomeSources as $incomeSource)
                                <tr>
                                    <td>{{ $incomeSource->name }}</td>
                                    <td class="text-right">{{ Auth::user()->formatCurrency($incomeSource->projected, true) }}</td>
                                    <td class="text-right">{{ Auth::user()->formatCurrency($incomeSource->actual, true) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                                <td class="text-right"><strong>{{ Auth::user()->formatCurrency($cashFlowPlan->projectedIncomeSourcesTotal(), true) }}</strong></td>
                                <td class="text-right"><strong>{{ Auth::user()->formatCurrency($cashFlowPlan->actualIncomeSourcesTotal(), true) }}</strong></td>
                            </tr>
                        </table>

                    </div>





                    <div id="actual_recurringExpenses" class="section actual-section">
                        <h3>
                            <a href="{{ route('family.cash-flow-plans.recurring-expenses.index', [$family, $cashFlowPlan]) }}">{{ __('recurring-expenses.recurring-expenses') }}</a>
                        </h3>

                        <table class="table table-sm">
                            <caption>{{ __('recurring-expenses.recurring-expenses') }}</caption>
                            <thead>
                                <tr>
                                    <td class="text-center">Name</td>
                                    <td class="text-right">Projected</td>
                                    <td class="text-right">Actual</td>
                                </tr>
                            </thead>
                            @foreach ($cashFlowPlan->recurringExpenses as $recurringExpense)
                                <tr>
                                    <td>{{ $recurringExpense->name }}</td>
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




                </div>

            </div>

        </div>

    </div>

@endsection
