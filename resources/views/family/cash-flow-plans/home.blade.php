@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Cash Flow Plans
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.cash-flow-plans.index.css') }}" />
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ asset('js/family.categories.index.js') }}"></script>--}}
@endpush


@php

$curYear  = date('Y');
$curMonth = (string) date('m');

$months = [
    '01',
    '02',
    '03',
    '04',
    '05',
    '06',
    '07',
    '08',
    '09',
    '10',
    '11',
    '12',
];

@endphp


@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
        ],
        'location'   => 'Cash Flow Plans',
    ])
        {{--'menu' => [
            ['type' => 'link', 'href' => route('family.categories.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('categories.add-new-category')],
        ]--}}

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>Cash Flow Plans</h2>

            <hr>

            @foreach ($years as $year)

                <h3>{{ $year }}</h3>

                <div class="row">

                    @foreach ($months as $month)

                        @php
                            $cashFlowPlan = $cashFlowPlans->where('year', $year)->firstWhere('month', $month);

                            $hasPlan = false;

                            if ($cashFlowPlan) {
                                $href = route('family.cash-flow-plans.show', [$family, $cashFlowPlan]);
                                $hasPlan = true;
                            } else {
                                $href = route('family.cash-flow-plans.create-plan', [$family, $year, $month]);
                            }

                            $curMonthClass = '';
                            if ($curYear == $year && $curMonth == $month) {
                                $curMonthClass = 'current-month';
                            }
                        @endphp

                        <div class="col-6 col-sm-4 col-lg-3 mb-3">

                            <a href="{{ $href }}">
                                <div class="card shadow {{ $curMonthClass }}">
                                    <div class="card-body">
                                        {{ __('months.' .$month) }}
                                        <hr>

                                        @if ($hasPlan)

                                            {{ Auth::user()->formatCurrency($cashFlowPlan->allActualExpensesTotal(), true) }}

                                        @else
                                            Begin Plan
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>

                    @endforeach

                </div>

            @endforeach

            {{--<hr>

            <div class="accordion" id="budgetsAccordion">

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
                                        $cashFlowPlan = $cashFlowPlans->where('year', $year)->firstWhere('month', $key);
                                    @endphp

                                    <li class="list-group-item">

                                        @if ($cashFlowPlan)

                                            <a href="{{ route('family.cash-flow-plans.show', [$family, $cashFlowPlan]) }}">{{ $key }}/{{ $cashFlowPlan->year }}</a>

                                        @else
                                            No cash flow plan found - Create one now
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
