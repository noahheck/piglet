@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('income-sources.income-sources') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family.categories.index.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ asset('js/family.categories.index.js') }}"></script>--}}
@endpush


@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.cash-flow-plans.index', [$family]) => __('cash-flow-plans.cash-flow-plans'),
            route('family.cash-flow-plans.show', [$family, $cashFlowPlan]) => __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year,
        ],
        'location'   => __('income-sources.income-sources'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.cash-flow-plans.income-sources.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('income-sources.add-new-income-source')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} {{ __('income-sources.income-sources') }}</h2>

            <ul class="nav nav-tabs" id="budgetTabs" role="tablist">
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

                            @if ($cashFlowPlan->incomeSources->where('type', 'budget')->count() === 0)

                                {{ __('income-sources.no-income-sources-create') }}
                                <p class="text-center">
                                    <a class="btn btn-primary" href="{{ route('family.cash-flow-plans.income-sources.create', [$family, $cashFlowPlan]) }}">
                                        <span class="fa fa-plus-circle"></span>
                                        {{ __('income-sources.add-new-income-source') }}
                                    </a>
                                </p>

                            @else

                                <ul class="list-group shadow income-sources" id="budgeted-income-sources">
                                    @foreach ($cashFlowPlan->incomeSources->where('type', 'budget') as $source)
                                        <li class="list-group-item">
                                            <a href="{{ route('family.cash-flow-plans.income-sources.edit', [$family, $cashFlowPlan, $source]) }}">
                                                {{ $source->name }} - {{ Auth::user()->formatCurrency($source->amount, true) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                <hr>

                                <h5>{{ __('cash-flow-plans.total') }}: {{ Auth::user()->formatCurrency($cashFlowPlan->incomeSources->where('type', 'budget')->sum('amount'), true) }}</h5>

                            @endif


                        </div>

                    </div>

                </div>


                <div class="tab-pane fade" id="actual" role="tabpanel" aria-labelledby="actualTab">

                    <div class="row justify-content-center mt-3">

                        <div class="col-12 col-md-10 col-lg-8 col-xl-6">

                            @if ($cashFlowPlan->incomeSources->where('type', 'actual')->count() === 0)

                                {{ __('income-sources.no-income-sources-create') }}
                                <p class="text-center">
                                    <a class="btn btn-primary" href="{{ route('family.cash-flow-plans.income-sources.create', [$family, $cashFlowPlan]) }}">
                                        <span class="fa fa-plus-circle"></span>
                                        {{ __('income-sources.add-new-income-source') }}
                                    </a>
                                </p>

                            @else

                                <ul class="list-group shadow income-sources" id="actual-income-sources">
                                    @foreach ($cashFlowPlan->incomeSources->where('type', 'actual') as $source)
                                        <li class="list-group-item">
                                            <a href="{{ route('family.cash-flow-plans.income-sources.edit', [$family, $cashFlowPlan, $source]) }}">
                                                {{ $source->name }} - {{ Auth::user()->formatCurrency($source->amount, true) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                <hr>

                                <h5>{{ __('cash-flow-plans.total') }}: {{ Auth::user()->formatCurrency($cashFlowPlan->incomeSources->where('type', 'actual')->sum('amount'), true) }}</h5>


                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
