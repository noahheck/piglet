@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('money-matters.money-matters') }}
@endsection

@push('stylesheets')
{{--    <link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [],
        'location'   => __('money-matters.money-matters'),
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'home'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('money-matters.money-matters') }}</h2>

            <hr>


            @if (count($yearOptions) > 1)
                <div class="float-right">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="yearSelectMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select Year
                        </button>
                        <div class="dropdown-menu" aria-labelledby="yearSelectMenuButton">
                            @foreach ($yearOptions as $year)
                                <a class="dropdown-item" href="{{ route('family.money-matters', [$family, 'year' => $year]) }}">{{ $year }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif


            <h4>{{ __('money-matters.monthly-balance') }}</h4>

            <canvas id="annualBalanceChart" class="piglet-chart" data-chart-data='@json($chartDataProvider->annualBalanceChartData())'></canvas>



            <h4 class="mt-3">{{ __('money-matters.lifestyle-expense-totals') }}</h4>

            <div class="row">

                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">

                            <h4>{{ __('cash-flow-plans.retirement') }}</h4>

                            <h5>{{ \App\formatCurrency($cashFlowPlans->where('retirement_distributed', true)->sum('retirement'), true) }}</h5>

                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">

                            <h4>{{ __('cash-flow-plans.education') }}</h4>

                            <h5>{{ \App\formatCurrency($cashFlowPlans->where('education_distributed', true)->sum('education'), true) }}</h5>

                        </div>
                    </div>
                </div>

            </div>



            <h4 class="mt-3">{{ __('money-matters.category-totals') }}</h4>

            <canvas id="categoryTotalsChart" class="piglet-chart" data-chart-data='@json($chartDataProvider->categoryTotalsChartData())'></canvas>


        </div>

    </div>

@endsection
