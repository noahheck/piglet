@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('expenses.expenses') }} - {{ $expense->title() }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
{{--    <script type="text/javascript" src="{{ mix('js/family.merchants.index.js') }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.cash-flow-plans.index', [$family]) => __('cash-flow-plans.cash-flow-plans'),
            route('family.cash-flow-plans.show', [$family, $cashFlowPlan]) => __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year,
            route('family.cash-flow-plans.expenses.index', [$family, $cashFlowPlan]) => __('expenses.expenses'),
        ],
        'location'   => $expense->title(),
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

            <h2>{{ $expense->title() }}</h2>

            @if ($expense->date)
                <h3>{{ App\formatDate($expense->date) }}</h3>
            @endif

            <dl>

                @if ($expense->expenseGroup)
                    <dt>{{ __('expense-groups.expense-group') }}</dt>
                    <dd>{{ $expense->expenseGroup->name  }}</dd>
                @endif

                @if ($expense->projected)
                    <dt>{{ __('expenses.projected') }}</dt>
                    <dd>{{ App\formatCurrency($expense->projected, true) }}</dd>
                @endif

                @if ($expense->actual)
                    <dt>{{ __('expenses.actual') }}</dt>
                    <dd>{{ App\formatCurrency($expense->actual, true) }}</dd>
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
