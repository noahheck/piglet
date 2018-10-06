@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('piggy-banks.piggy-bank-contributions') }}
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
        'location'   => __('piggy-banks.piggy-bank-contributions'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.cash-flow-plans.piggy-bank-contributions.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('piggy-banks.add-new-contribution')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])


        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} {{ __('piggy-banks.piggy-bank-contributions') }}</h2>

            @if ($contributions->count() === 0)

                {{ __('piggy-banks.no-contributions-create') }}
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.cash-flow-plans.piggy-bank-contributions.create', [$family, $cashFlowPlan]) }}">
                        <span class="fa fa-plus-circle"></span>
                        {{ __('piggy-banks.add-new-contribution') }}
                    </a>
                </p>

            @else

                <table class="table table-sm">
                    <caption>{{ __('piggy-banks.piggy-bank-contributions') }}</caption>
                    <thead>
                    <tr class="font-weight-bold">
                        <td>{{ __('piggy-banks.piggy-bank') }}</td>
                        <td>{{ __('piggy-banks.date') }}</td>
                        <td class="text-right">{{ __('piggy-banks.projected') }}</td>
                        <td class="text-right">{{ __('piggy-banks.actual') }}</td>
                    </tr>
                    </thead>

                    @foreach ($contributions as $contribution)

                        <tr>
                            <td><a href="{{ route('family.cash-flow-plans.piggy-bank-contributions.edit', [$family, $cashFlowPlan, $contribution]) }}">{{ $contribution->piggyBank->piggyBank->name }}</a></td>
                            <td>{{ App\formatDate($contribution->date) }}</td>
                            <td class="text-right">{{ App\formatCurrency($contribution->projected, true) }}</td>
                            <td class="text-right">{{ App\formatCurrency($contribution->actual, true) }}</td>
                        </tr>

                    @endforeach

                    <tr>
                        <td colspan="2"><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                        <td class="text-right"><strong>{{ App\formatCurrency($contributions->sum('projected'), true) }}</strong></td>
                        <td class="text-right"><strong>{{ App\formatCurrency($contributions->sum('actual'), true) }}</strong></td>
                    </tr>
                </table>

            @endif

        </div>

    </div>

@endsection
