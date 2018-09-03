@extends('layouts.app')

@php
    $merchantDate = __('expenses.no-merchant');
    if ($expense->merchant) {
        $merchantDate = $expense->merchant->name;
    }

    if ($expense->date) {
        $merchantDate .= ' (' . Auth::user()->formatDate($expense->date) . ')';
    }
@endphp

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('expenses.expenses') }} - {{ $merchantDate }}
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
            route('family.cash-flow-plans.expenses.index', [$family, $cashFlowPlan]) => __('expenses.expenses'),
        ],
        'location'   => $merchantDate,
        'menu' => [
            /*['type' => 'delete', 'href' => route('family.cash-flow-plans.recurring-expenses.destroy', [$family, $cashFlowPlan, $recurringExpense]), 'text' => __('form.delete') . ' ' . __('recurring-expenses.recurring-expense')],*/
            ['type' => 'link', 'href' => route('family.cash-flow-plans.expenses.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('expenses.add-new-expense')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.expenses.edit', [$family, $cashFlowPlan, $expense]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            @if ($expense->merchant)
                <h2>{{ $expense->merchant->name }} {{ ($expense->date) ? '(' . Auth::user()->formatDate($expense->date) . ')' : '' }}</h2>
            @endif

            @if ($expense->description)
                <h3>{{ $expense->description }}</h3>
            @endif

            <dl>

                @if ($expense->expenseGroup)
                    <dt>{{ __('expense-groups.expense-group') }}</dt>
                    <dd>{{ $expense->expenseGroup->name  }}</dd>
                @endif

                @if ($expense->projected)
                    <dt>{{ __('expenses.projected') }}</dt>
                    <dd>{{ Auth::user()->formatCurrency($expense->projected, true) }}</dd>
                @endif

                @if ($expense->actual)
                    <dt>{{ __('expenses.actual') }}</dt>
                    <dd>{{ Auth::user()->formatCurrency($expense->actual, true) }}</dd>
                @endif

                @if ($expense->category)
                    <dt>{{ __('expenses.category') }}</dt>
                    <dd>{{ $expense->category->name }} {{ ($expense->sub_category) ? '(' . $expense->sub_category . ')' : '' }}</dd>
                @endif

                <dt>{{ __('expenses.details') }}</dt>
                <dd>{!! nl2br(e($expense->detail)) !!}</dd>

            </dl>

        </div>

    </div>

@endsection
