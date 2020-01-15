@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.cash-flow-plans.index.css') }}" />
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ mix('js/family.categories.index.js') }}"></script>--}}
@endpush


@php

$today = \Auth::user()->today();

$curYear  = $today->format('Y');
$curMonth = (string) $today->format('m');

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
        'location'   => __('cash-flow-plans.cash-flow-plans'),
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('cash-flow-plans.cash-flow-plans') }}</h2>

            <hr>

            <div class="accordion" id="cfps">

                @foreach ($years as $year)

                    <div class="card">
                        <div class="card-header" id="{{ $year }}_header">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#cfp_{{ $year }}" aria-expanded="{{ ($year == $currentCfpYear) ? 'true' : 'false' }}" aria-controls="cfp_{{ $year }}">
                                    <span class="fa fa-chevron-down"></span> {{ $year }}
                                </button>
                            </h5>
                        </div>

                        <div class="collapse {{ ($year == $currentCfpYear) ? 'show' : '' }}" id="cfp_{{ $year }}" aria-labelledby="{{ $year }}_header" data-parent="#cfps">
                            <div class="card-body">
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


                                        <div class="col-6 col-lg-4 mb-3">

                                            <a class="card shadow {{ $curMonthClass }}" href="{{ $href }}">
                                                <div class="card-body text-center">
                                                    {{ __('months.' .$month) }}
                                                    <hr>

                                                    @if ($hasPlan)

                                                        <canvas id="cfpBalanceChart_{{ $cashFlowPlan->id }}" class="piglet-chart" data-chart-data='@json($cashFlowPlan->actualBalanceChartData(false))'></canvas>

                                                    @else
                                                        <p>
                                                <span class="fa-stack fa-lg">
                                                    <span class="fa fa-file-o fa-stack-2x"></span>
                                                    <span class="fa fa-bar-chart fa-stack-1x"></span>
                                                </span>
                                                        </p>
                                                        <p>{{ __('cash-flow-plans.create-plan') }}</p>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>

                                    @endforeach

                                </div>
                            </div>
                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

@endsection
