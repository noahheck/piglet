@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('piggy-banks.piggy-banks') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family.categories.index.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ mix('js/family.cash-flow-plans.income-sources.index.js') }}"></script>--}}
@endpush


@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.cash-flow-plans.index', [$family]) => __('cash-flow-plans.cash-flow-plans'),
            route('family.cash-flow-plans.show', [$family, $cashFlowPlan]) => __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year,
        ],
        'location'   => __('piggy-banks.piggy-banks'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.cash-flow-plans.piggy-bank-contributions.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-dollar', 'text' => __('piggy-banks.add-new-contribution')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.piggy-banks.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('piggy-banks.add-new-piggy-bank')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])


        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} {{ __('piggy-banks.piggy-banks') }}</h2>

            @if ($piggyBanks->count() === 0)

                {{ __('piggy-banks.no-piggy-banks-create') }}
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.cash-flow-plans.piggy-banks.create', [$family, $cashFlowPlan]) }}">
                        <span class="fa fa-plus-circle"></span>
                        {{ __('piggy-banks.add-new-piggy-bank') }}
                    </a>
                </p>

            @else

                <table class="table table-sm">
                    <caption>{{ __('piggy-banks.piggy-banks') }}</caption>
                    <thead>
                    <tr class="font-weight-bold">
                        <td class="text-center">{{ __('piggy-banks.name') }}</td>
                        <td class="text-right">{{ __('piggy-banks.projected') }}</td>
                        <td class="text-right">{{ __('piggy-banks.actual') }}</td>
                    </tr>
                    </thead>

                    @foreach ($piggyBanks as $piggyBank)
                        <tr>
                            <td ><a href="{{ route('family.cash-flow-plans.piggy-banks.show', [$family, $cashFlowPlan, $piggyBank]) }}">{{ $piggyBank->name }}</a></td>
                            <td class="text-right">{{ App\formatCurrency($piggyBank->projected, true) }}</td>
                            <td class="text-right">{{ App\formatCurrency($piggyBank->actualTotal(), true) }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                        <td class="text-right"><strong>{{ App\formatCurrency($piggyBanks->sum('projected'), true) }}</strong></td>
                        <td class="text-right"><strong>{{ App\formatCurrency($piggyBanks->reduce(function($carry, $piggyBank) { return $carry + $piggyBank->actualTotal();}), true) }}</strong></td>
                    </tr>
                </table>

            @endif

        </div>

    </div>

@endsection
