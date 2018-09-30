@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('expense-groups.expense-groups') }}
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
        'location'   => __('expense-groups.expense-groups'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.cash-flow-plans.expense-groups.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('expense-groups.add-new-expense-group')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])


        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} {{ __('expense-groups.expense-groups') }}</h2>

            @if ($expenseGroups->count() === 0)

                {{ __('expense-groups.no-expense-groups-create') }}
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.cash-flow-plans.expense-groups.create', [$family, $cashFlowPlan]) }}">
                        <span class="fa fa-plus-circle"></span>
                        {{ __('expense-groups.add-new-expense-group') }}
                    </a>
                </p>

            @else

                <table class="table table-sm">
                    <caption>{{ __('expense-groups.expense-groups') }}</caption>
                    <thead>
                    <tr class="font-weight-bold">
                        <td class="text-center">{{ __('expense-groups.name') }}</td>
                        <td class="text-right">{{ __('expense-groups.projected') }}</td>
                        <td class="text-right">{{ __('expense-groups.actual') }}</td>
                    </tr>
                    </thead>

                    @foreach ($expenseGroups->where('category_id', null) as $expenseGroup)

                        <tr id="expenseGroup_{{ $expenseGroup->id }}" data-expense-group-id="{{ $expenseGroup->id }}">
                            <td style="border-left: 4px solid transparent" title="{{ $expenseGroup->name }} - {{ __('expense-groups.uncategorized') }}"><a href="{{ route('family.cash-flow-plans.expense-groups.show', [$family, $cashFlowPlan, $expenseGroup]) }}">{{ $expenseGroup->name }}</a></td>
                            <td class="text-right">{{ App\formatCurrency($expenseGroup->projected, true) }}</td>
                            <td class="text-right">{{ App\formatCurrency($expenseGroup->actualTotal(), true) }}</td>
                        </tr>

                    @endforeach

                    @foreach ($categories as $category)
                        @foreach ($expenseGroups->where('category_id', $category->id) as $expenseGroup)
                            <tr id="expenseGroup_{{ $expenseGroup->id }}" data-expense-group-id="{{ $expenseGroup->id }}">
                                <td style="border-left: 4px solid {{ $category->color }}" title="{{ $expenseGroup->name }} - {{ $category->name }}"><a href="{{ route('family.cash-flow-plans.expense-groups.show', [$family, $cashFlowPlan, $expenseGroup]) }}">{{ $expenseGroup->name }}</a></td>
                                <td class="text-right">{{ App\formatCurrency($expenseGroup->projected, true) }}</td>
                                <td class="text-right">{{ App\formatCurrency($expenseGroup->actualTotal(), true) }}</td>
                            </tr>
                        @endforeach
                    @endforeach

                    <tr>
                        <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                        <td class="text-right"><strong>{{ App\formatCurrency($expenseGroups->sum('projected'), true) }}</strong></td>
                        <td class="text-right"><strong>{{ App\formatCurrency($expenseGroups->reduce(function($carry, $expenseGroup) { return $carry + $expenseGroup->actualTotal();}), true) }}</strong></td>
                    </tr>
                </table>

            @endif

        </div>

    </div>

@endsection
