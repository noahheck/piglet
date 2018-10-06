@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('piggy-banks.piggy-banks') }} - {{ $piggyBank->name }}
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
        ],
        'location'   => $piggyBank->name,
        'menu' => [
            /*['type' => 'delete', 'href' => route('family.cash-flow-plans.recurring-expenses.destroy', [$family, $cashFlowPlan, $recurringExpense]), 'text' => __('form.delete') . ' ' . __('recurring-expenses.recurring-expense')],*/
            ['type' => 'link', 'href' => route('family.cash-flow-plans.piggy-banks.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('piggy-banks.add-new-piggy-bank')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.piggy-bank-contributions.create', [$family, $cashFlowPlan, 'piggy_bank_id' => $piggyBank->id]), 'icon' => 'fa fa-dollar', 'text' => __('piggy-banks.add-new-contribution')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.piggy-banks.edit', [$family, $cashFlowPlan, $piggyBank]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            {{--<div class="row mt-5 mt-md-0 mb-5">

                <div class="col-12">

                    <div class="card shadow" style="border-top: 3px solid {{ $expenseGroup->category ? $expenseGroup->category->color : '' }}">

                        <div class="card-body">

                            @if ($expenseGroup->category)
                                <span class="text-muted float-right">{{ $expenseGroup->category->name }}</span>
                            @endif

                            <h2>{{ $expenseGroup->name }}</h2>

                                <p class="card-text">
                                    {{ App\formatCurrency($expenseGroup->actualTotal(), true) }} / {{ App\formatCurrency($expenseGroup->projected, true) }}
                                </p>

                                <div class="progress">

                                    @php
                                        $statusClass = '';
                                        if ($expenseGroup->isOverspent()) {
                                            $statusClass = 'bg-danger';
                                        } elseif ($expenseGroup->isCloseToOverspent()) {
                                            $statusClass = 'bg-warning';
                                        }
                                    @endphp

                                    <div class="progress-bar {{ $statusClass }}" role="progressbar" style="width: {{ $expenseGroup->percentUtilized() }}%" aria-valuenow="{{ $expenseGroup->actualTotal() }}" aria-valuemin="0" aria-valuemax="{{ App\formatCurrency($expenseGroup->projected, false) }}"></div>
                                </div>

                        </div>

                        @if ($expenseGroup->detail)
                            {!! nl2br(e($expenseGroup->detail)) !!}
                        @endif

                    </div>

                </div>

            </div>--}}

            <table class="table table-sm">
                <caption>{{ $piggyBank->name }}</caption>
                <thead>
                    <tr class="font-weight-bold">
                        <td>{{ __('piggy-banks.date') }}</td>
                        <td class="text-right">{{ __('piggy-banks.projected') }}</td>
                        <td class="text-right">{{ __('piggy-banks.actual') }}</td>
                    </tr>
                </thead>

                @foreach ($piggyBank->contributions as $contribution)
                    <tr>
                        <td><a href="{{ route('family.cash-flow-plans.piggy-bank-contributions.edit', [$family, $cashFlowPlan, $contribution]) }}">{{ $contribution->title() }}</a></td>
                        <td class="text-right">{{ App\formatCurrency($contribution->projected, true) }}</td>
                        <td class="text-right">{{ App\formatCurrency($contribution->actual, true) }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                    <td class="text-right"><strong>{{ App\formatCurrency($piggyBank->projected, true) }}</strong></td>
                    <td class="text-right"><strong>{{ App\formatCurrency($piggyBank->actualTotal(), true) }}</strong></td>
                </tr>

            </table>

            <div class="text-right">
                <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.piggy-bank-contributions.create', [$family, $cashFlowPlan, 'piggy_bank_id' => $piggyBank->id]) }}">{{ __('piggy-banks.add-new-contribution') }}</a>
            </div>

        </div>

    </div>

@endsection
