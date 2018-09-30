@extends('layouts.app')

@php
    $categories = \App\Family\Category::where('active', true)->orderBy('d_order')->get();

    //$expenseGroupTemplates = \App\Family\ExpenseGroup::where('active', true)->orderBy('name')->get();
@endphp

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
            ['type' => 'link', 'href' => route('family.cash-flow-plans.expenses.create', [$family, $cashFlowPlan, 'return' => url()->current(), 'expense_group_id' => $expenseGroup->id]), 'icon' => 'fa fa-dollar', 'text' => __('expenses.add-new-expense')],
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

                <dt>{{ __('expense-groups.actual') }} / {{ __('expense-groups.projected') }}</dt>
                <dd>{{ App\formatCurrency($expenseGroup->actualTotal(), true) }} / {{ App\formatCurrency($expenseGroup->projected, true) }}</dd>

                <dt>{{ __('recurring-expenses.category') }}</dt>
                <dd>{{ $expenseGroup->category ? $expenseGroup->category->name : ''}} {{ ($expenseGroup->sub_category) ? '(' . $expenseGroup->sub_category . ')' : '' }}</dd>

            </dl>

            @if ($expenseGroup->detail)
                {!! nl2br(e($expenseGroup->detail)) !!}
            @endif


            <table class="table table-sm">
                <caption>{{ $expenseGroup->name }}</caption>
                <thead>
                <tr class="font-weight-bold">
                    <td>{{ __('expenses.date') }}</td>
                    <td>{{ __('expenses.merchant') }}</td>
                    <td class="text-right">{{ __('expenses.projected') }}</td>
                    <td class="text-right">{{ __('expenses.actual') }}</td>
                </tr>
                </thead>

                @foreach ($expenseGroup->expenses->where('category_id', null) as $expense)
                    <tr>
                        <td style="border-left: 4px solid transparent">{{ Auth::user()->formatDate($expense->date) }}</td>
                        <td><a href="{{ route('family.cash-flow-plans.expenses.edit', [$family, $cashFlowPlan, $expense, 'return' => url()->current()]) }}">{{ $expense->title() }}</a></td>
                        <td class="text-right">{{ ($expense->projected) ? App\formatCurrency($expense->projected, true) : '' }}</td>
                        <td class="text-right">{{ ($expense->actual) ? App\formatCurrency($expense->actual, true) : '' }}</td>
                    </tr>
                @endforeach

                @foreach ($categories as $category)
                    @foreach ($expenseGroup->expenses->where('category_id', $category->id) as $expense)
                        <tr>
                            <td style="border-left: 4px solid {{ $category->color }}" title="{{ $category->name }}">{{ Auth::user()->formatDate($expense->date) }}</td>
                            <td><a href="{{ route('family.cash-flow-plans.expenses.edit', [$family, $cashFlowPlan, $expense, 'return' => url()->current()]) }}">{{ $expense->title() }}</a></td>
                            <td class="text-right">{{ ($expense->projected) ? App\formatCurrency($expense->projected, true) : '' }}</td>
                            <td class="text-right">{{ ($expense->actual) ? App\formatCurrency($expense->actual, true) : '' }}</td>
                        </tr>
                    @endforeach
                @endforeach

                <tr>
                    <td colspan="2"><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                    <td class="text-right"><strong>{{ App\formatCurrency($expenseGroup->expenses->sum('projected'), true) }}</strong></td>
                    <td class="text-right"><strong>{{ App\formatCurrency($expenseGroup->expenses->sum('actual'), true) }}</strong></td>
                </tr>

            </table>

            <div class="text-right">
                <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.expenses.create', [$family, $cashFlowPlan, 'return' => url()->current(), 'expense_group_id' => $expenseGroup->id]) }}">{{ __('expenses.add-new-expense') }}</a>
            </div>

        </div>

    </div>

@endsection
