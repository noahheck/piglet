@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('recurring-expenses.recurring-expenses') }}
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
        'location'   => __('recurring-expenses.recurring-expenses'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.cash-flow-plans.recurring-expenses.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('recurring-expenses.add-new-recurring-expense')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} {{ __('recurring-expenses.recurring-expenses') }}</h2>

            @if ($recurringExpenses->count() === 0)

                {{ __('recurring-expenses.no-recurring-expenses-create') }}
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.cash-flow-plans.recurring-expenses.create', [$family, $cashFlowPlan]) }}">
                        <span class="fa fa-plus-circle"></span>
                        {{ __('recurring-expenses.add-new-recurring-expense') }}
                    </a>
                </p>

            @else

                <table class="table table-sm">
                    <caption>{{ __('recurring-expenses.recurring-expenses') }}</caption>
                    <thead>
                    <tr class="font-weight-bold">
                        <td class="text-center">{{ __('recurring-expenses.name') }}</td>
                        <td class="text-right">{{ __('recurring-expenses.projected') }}</td>
                        <td class="text-right">{{ __('recurring-expenses.actual') }}</td>
                    </tr>
                    </thead>

                    @foreach ($recurringExpenses->where('category_id', null) as $recurringExpense)

                        <tr id="recurringExpense_{{ $recurringExpense->id }}" data-recurring-expense-id="{{ $recurringExpense->id }}">
                            <td style="border-left: 4px solid transparent" title="{{ $recurringExpense->name }} - {{ __('recurring-expenses.uncategorized') }}"><a href="{{ route('family.cash-flow-plans.recurring-expenses.edit', [$family, $cashFlowPlan, $recurringExpense]) }}">{{ $recurringExpense->name }}</a></td>
                            <td class="text-right">{{ Auth::user()->formatCurrency($recurringExpense->projected, true) }}</td>
                            <td class="text-right">{{ Auth::user()->formatCurrency($recurringExpense->actual, true) }}</td>
                        </tr>

                    @endforeach

                    @foreach ($categories as $category)
                        @foreach ($recurringExpenses->where('category_id', $category->id) as $recurringExpense)
                            <tr id="recurringExpense_{{ $recurringExpense->id }}" data-recurring-expense-id="{{ $recurringExpense->id }}">
                                <td style="border-left: 4px solid {{ $category->color }}" title="{{ $recurringExpense->name }} - {{ $category->name }}"><a href="{{ route('family.cash-flow-plans.recurring-expenses.edit', [$family, $cashFlowPlan, $recurringExpense]) }}">{{ $recurringExpense->name }}</a></td>
                                <td class="text-right">{{ Auth::user()->formatCurrency($recurringExpense->projected, true) }}</td>
                                <td class="text-right">{{ Auth::user()->formatCurrency($recurringExpense->actual, true) }}</td>
                            </tr>
                        @endforeach
                    @endforeach

                    <tr>
                        <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                        <td class="text-right"><strong>{{ Auth::user()->formatCurrency($cashFlowPlan->projectedRecurringExpensesTotal(), true) }}</strong></td>
                        <td class="text-right"><strong>{{ Auth::user()->formatCurrency($cashFlowPlan->actualRecurringExpensesTotal(), true) }}</strong></td>
                    </tr>
                </table>

            @endif

        </div>

    </div>

@endsection
