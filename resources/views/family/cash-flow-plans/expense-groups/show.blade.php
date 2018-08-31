@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('expense-groups.expense-groups') }} - {{ $expenseGroup->name }}
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
            route('family.cash-flow-plans.expense-groups.index', [$family, $cashFlowPlan]) => __('expense-groups.expense-groups'),
        ],
        'location'   => $expenseGroup->name,
        'menu' => [
            /*['type' => 'delete', 'href' => route('family.cash-flow-plans.recurring-expenses.destroy', [$family, $cashFlowPlan, $recurringExpense]), 'text' => __('form.delete') . ' ' . __('recurring-expenses.recurring-expense')],*/
            ['type' => 'link', 'href' => route('family.cash-flow-plans.expense-groups.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('expense-groups.add-new-expense-group')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.expense-groups.edit', [$family, $cashFlowPlan, $expenseGroup]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ $expenseGroup->name }}</h2>

            <dl>

                <dt>{{ __('expense-groups.projected') }}</dt>
                <dd>{{ Auth::user()->formatCurrency($expenseGroup->projected, true) }}</dd>

                <dt>{{ __('recurring-expenses.category') }}</dt>
                <dd>{{ $expenseGroup->category->name }} {{ ($expenseGroup->sub_category) ? '(' . $expenseGroup->sub_category . ')' : '' }}</dd>

                <dt>{{ __('expense-groups.details') }}</dt>
                <dd>{!! nl2br(e($expenseGroup->detail)) !!}</dd>

            </dl>

        </div>

    </div>

@endsection
