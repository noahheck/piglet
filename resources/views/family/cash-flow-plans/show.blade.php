@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Budgets - {{ __('months.' . $cashFlowPlan->month) }} {{ $cashFlowPlan->year }}
@endsection

@push('stylesheets')
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.categories.index.css') }}" />--}}
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
            route('family.cash-flow-plans.index', [$family]) => 'Budgets',
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
                    <a class="nav-link" id="expensesTab" data-toggle="tab" href="#expenses" role="tab" aria-controls="expenses" aria-selected="false">Expenses</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overviewTab">
                    Overview
                </div>

                <div class="tab-pane fade" id="budget" role="tabpanel" aria-labelledby="budgetTab">
                    Budget
                </div>

                <div class="tab-pane fade" id="expenses" role="tabpanel" aria-labelledby="expensesTab">
                    Expenses
                </div>
            </div>

            {{--<div class="accordion" id="budgetsAccordion">

                @foreach ($years as $year)

                    <div class="card" id="heading_{{ $year }}">
                        <div class="card-header">
                            <h5>
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse_{{ $year }}">
                                    {{ $year }}
                                </button>
                            </h5>
                        </div>

                        <div id="collapse_{{ $year }}" class="collapse" data-parent="#budgetsAccordion">

                            <ul class="list-group list-group-flush">

                                @foreach($months as $key => $month)

                                    @php
                                        $budget = $cash-flow-plans->where('year', $year)->firstWhere('month', $key);
                                    @endphp

                                    <li class="list-group-item">

                                        @if ($budget)

                                            <a href="{{ route('family.cash-flow-plans.show', [$family, $budget]) }}">{{ $key }}/{{ $budget->year }}</a>

                                        @else
                                            No budget found - Create one now
                                        @endif
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                @endforeach

            </div>--}}

        </div>

    </div>

@endsection
