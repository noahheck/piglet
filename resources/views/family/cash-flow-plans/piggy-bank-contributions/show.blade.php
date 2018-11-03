@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('piggy-banks.piggy-banks') }} - {{ $contribution->piggyBank->name }} - {{ $contribution->title() }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
{{--    <script type="text/javascript" src="{{ asset('js/family.merchants.index.js') }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.cash-flow-plans.index', [$family]) => __('cash-flow-plans.cash-flow-plans'),
            route('family.cash-flow-plans.show', [$family, $cashFlowPlan]) => __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year,
            route('family.cash-flow-plans.piggy-banks.index', [$family, $cashFlowPlan]) => __('piggy-banks.piggy-banks'),
            route('family.cash-flow-plans.piggy-banks.show', [$family, $cashFlowPlan, $contribution->piggyBank]) => $contribution->piggyBank->name,
        ],
        'location'   => $contribution->title(),
        'menu' => [
            /*['type' => 'delete', 'href' => route('family.cash-flow-plans.recurring-expenses.destroy', [$family, $cashFlowPlan, $recurringExpense]), 'text' => __('form.delete') . ' ' . __('recurring-expenses.recurring-expense')],*/
            ['type' => 'link', 'href' => route('family.cash-flow-plans.piggy-bank-contributions.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('piggy-banks.add-new-contribution')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.piggy-bank-contributions.edit', [$family, $cashFlowPlan, $contribution]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ $contribution->title() }}</h2>

            @if ($contribution->date)
                <h3>{{ App\formatDate($contribution->date) }}</h3>
            @endif

            <dl>

                @if ($contribution->actual)
                    <dt>{{ __('piggy-banks.contribution') }}</dt>
                    <dd>{{ App\formatCurrency($contribution->actual, true) }}</dd>
                @endif

                <dt>{{ __('piggy-banks.details') }}</dt>
                <dd>{!! nl2br(e($contribution->detail)) !!}</dd>

            </dl>

        </div>

    </div>

@endsection
