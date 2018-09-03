@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('expenses.expenses') }}
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
        'location'   => __('expenses.expenses'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.cash-flow-plans.expenses.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('expenses.add-new-expense')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])


        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} {{ __('expenses.expenses') }}</h2>

            @if ($expenses->count() === 0)

                {{ __('expenses.no-expenses-create') }}
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.cash-flow-plans.expenses.create', [$family, $cashFlowPlan]) }}">
                        <span class="fa fa-plus-circle"></span>
                        {{ __('expenses.add-new-expense') }}
                    </a>
                </p>

            @else

                <table class="table table-sm">
                    <caption>{{ __('expenses.expenses') }}</caption>
                    <thead>
                    <tr class="font-weight-bold">
                        <td>{{ __('expenses.date') }}</td>
                        <td>{{ __('expenses.merchant') }}</td>
                        <td class="text-right">{{ __('expenses.projected') }}</td>
                        <td class="text-right">{{ __('expenses.actual') }}</td>
                    </tr>
                    </thead>

                    @foreach ($expenses->where('category_id', null) as $expense)

                        <tr id="expense_{{ $expense->id }}" data-expense-id="{{ $expense->id }}">
                            <td style="border-left: 4px solid transparent" title="{{ $expense->title()  }} - {{ __('expenses.uncategorized') }}">{{ Auth::user()->formatDate($expense->date) }}</td>
                            <td title="{{ $expense->title() }} - {{ __('expenses.uncategorized') }}"><a href="{{ route('family.cash-flow-plans.expenses.edit', [$family, $cashFlowPlan, $expense]) }}">{{ $expense->title() }}</a></td>
                            <td class="text-right">{{ Auth::user()->formatCurrency($expense->projected, true) }}</td>
                            <td class="text-right">{{ Auth::user()->formatCurrency($expense->actual, true) }}</td>
                        </tr>

                    @endforeach

                    @foreach ($categories as $category)
                        @foreach ($expenses->where('category_id', $category->id) as $expense)
                            <tr id="expense_{{ $expense->id }}" data-expense-id="{{ $expense->id }}">
                                <td style="border-left: 4px solid {{ $category->color }}" title="{{ $expense->title() }} - {{ $category->name }}">{{ Auth::user()->formatDate($expense->date) }}</td>
                                <td title="{{ $expense->title() }}"><a href="{{ route('family.cash-flow-plans.expenses.edit', [$family, $cashFlowPlan, $expense]) }}">{{ $expense->title() }}</a></td>
                                <td class="text-right">{{ Auth::user()->formatCurrency($expense->projected, true) }}</td>
                                <td class="text-right">{{ Auth::user()->formatCurrency($expense->actual, true) }}</td>
                            </tr>
                        @endforeach
                    @endforeach

                    <tr>
                        <td colspan="2"><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                        <td class="text-right"><strong>{{ Auth::user()->formatCurrency($expenses->sum('projected'), true) }}</strong></td>
                        <td class="text-right"><strong>{{ Auth::user()->formatCurrency($expenses->sum('actual'), true) }}</strong></td>
                    </tr>
                </table>

            @endif

        </div>

    </div>

@endsection
