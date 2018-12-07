@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('recurring-expenses.recurring-expenses') }} - {{ $recurringExpense->name }}
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
            route('family.cash-flow-plans.recurring-expenses.index', [$family, $cashFlowPlan]) => __('recurring-expenses.recurring-expenses'),
        ],
        'location'   => $recurringExpense->name,
        'menu' => [
            /*['type' => 'delete', 'href' => route('family.cash-flow-plans.recurring-expenses.destroy', [$family, $cashFlowPlan, $recurringExpense]), 'text' => __('form.delete') . ' ' . __('recurring-expenses.recurring-expense')],*/
            ['type' => 'link', 'href' => route('family.cash-flow-plans.recurring-expenses.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('recurring-expenses.add-new-recurring-expense')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.recurring-expenses.edit', [$family, $cashFlowPlan, $recurringExpense]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ $recurringExpense->name }}</h2>

            <dl>

                <dt>{{ __('recurring-expenses.projected') }}</dt>
                <dd>{{ App\formatCurrency($recurringExpense->projected, true) }}</dd>

                @if ($recurringExpense->actual)
                    <dt>{{ __('recurring-expenses.actual') }}</dt>
                    <dd>{{ App\formatCurrency($recurringExpense->actual, true) }}</dd>
                @endif

                @if ($recurringExpense->date)
                    <dt>{{ __('recurring-expenses.date') }}</dt>
                    <dd>{{ App\formatDate($recurringExpense->date) }}</dd>
                @endif

                @if ($recurringExpense->payment_detail)
                    <dt>{{ __('recurring-expenses.payment-detail') }}</dt>
                    <dd>{{ $recurringExpense->payment_detail }}</dd>
                @endif

                <dt>{{ __('recurring-expenses.merchant') }}</dt>
                <dd><a href="{{ route('family.merchants.show', [$family, $recurringExpense->merchant]) }}">{{ $recurringExpense->merchant->name }}</a></dd>

                <dt>{{ __('recurring-expenses.category') }}</dt>
                <dd>{{ $recurringExpense->category->name }} {{ ($recurringExpense->sub_category) ? '(' . $recurringExpense->sub_category . ')' : '' }}</dd>

                <dt>{{ __('recurring-expenses.details') }}</dt>
                <dd>{!! nl2br(e($recurringExpense->detail)) !!}</dd>

            </dl>

        </div>

    </div>

@endsection
