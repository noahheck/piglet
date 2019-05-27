@extends('layouts.app')

@php

$lifestyleExpensesTotal = array_sum($lifestyleExpenses);

@endphp

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('form.create') }} - {{ __('months.' . $month) }} {{ $year }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.cash-flow-plans.create.css') }}" />
@endpush

@push('scripts')
{{--    <script type="text/javascript" src="{{ mix('js/family.categories.index.js') }}"></script>--}}
@endpush


@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.cash-flow-plans.index', [$family]) => __('cash-flow-plans.cash-flow-plans'),
        ],
        'location'   => __('form.create') . ' - ' .__('months.' . $month) . ' ' . $year,
    ])
        {{--'menu' => [
            ['type' => 'link', 'href' => route('family.categories.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('categories.add-new-category')],
        ]--}}

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('cash-flow-plans.create-for-month-year', ['month' => __('months.' . $month), 'year' => $year]) }}</h2>

            <hr>

            <p>
                {{ __('cash-flow-plans.created-with-entries') }}:
            </p>

            <div class="section">
                <h3>{{ __('income-sources.income-sources') }}</h3>

                <table class="table table-sm">
                    <caption>{{ __('income-sources.income-sources') }}</caption>
                    <thead>
                        <tr class="font-weight-bold">
                            <td>{{ __('income-sources.name') }}</td>
                            <td class="text-right">{{ __('income-sources.projected') }}</td>
                        </tr>
                    </thead>
                    @foreach ($incomeSources as $incomeSource)
                        <tr>
                            <td><a href="{{ route('family.income-sources.edit', [$family, $incomeSource, 'return' => url()->current()]) }}">{{ $incomeSource->name }}</a></td>
                            <td class="text-right">{{ App\formatCurrency($incomeSource->default_amount, true) }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                        <td class="text-right"><strong>{{ App\formatCurrency($incomeSources->sum('default_amount'), true) }}</strong></td>
                    </tr>
                </table>

            </div>

            <div class="section">
                <h3>{{ __('cash-flow-plans.lifestyle-expenses') }}</h3>

                <table class="table table-sm">
                    <caption>{{ __('cash-flow-plans.lifestyle-expenses') }}</caption>
                    <thead>
                        <tr class="font-weight-bold">
                            <td>{{ __('cash-flow-plans.lifestyle-expense-name') }}</td>
                            <td class="text-right">{{ __('cash-flow-plans.projected') }}</td>
                        </tr>
                    </thead>

                    @foreach ($lifestyleExpenses as $key => $value)
                        <tr>
                            <td>{{ __('cash-flow-plans.' . $key) }}</td>
                            <td class="text-right">{{ \App\formatCurrency($value, true) }}</td>
                        </tr>
                    @endforeach

                    <tr class="font-weight-bold">
                        <td>{{ __('cash-flow-plans.total') }}</td>
                        <td class="text-right">{{ \App\formatCurrency($lifestyleExpensesTotal, true) }}</td>
                    </tr>

                </table>

            </div>


            <div class="section">
                <h3>{{ __('piggy-banks.piggy-banks') }}</h3>

                <table class="table table-sm">
                    <caption>{{ __('piggy-banks.piggy-banks') }}</caption>
                    <thead>
                        <tr class="font-weight-bold">
                            <td>{{ __('piggy-banks.name') }}</td>
                            <td class="text-right">{{ __('piggy-banks.projected') }}</td>
                        </tr>
                    </thead>

                    @foreach ($piggyBanks as $piggyBank)
                        <tr>
                            <td>{{ $piggyBank->name }}</td>
                            <td class="text-right">{{ \App\formatCurrency($piggyBank->monthly_contribution, true) }}</td>
                        </tr>
                    @endforeach

                    <tr class="font-weight-bold">
                        <td>{{ __('cash-flow-plans.total') }}</td>
                        <td class="text-right">{{ \App\formatCurrency($piggyBanks->sum('monthly_contribution'), true) }}</td>
                    </tr>
                </table>

            </div>

            <div class="section">
                <h3>{{ __('recurring-expenses.recurring-expenses') }}</h3>

                <table class="table table-sm">
                    <caption>{{ __('recurring-expenses.recurring-expenses') }}</caption>
                    <thead>
                        <tr class="font-weight-bold">
                            <td>{{ __('recurring-expenses.name') }}</td>
                            <td class="text-right">{{ __('recurring-expenses.projected') }}</td>
                        </tr>
                    </thead>

                    @foreach ($recurringExpenses->where('category_id', null) as $recurringExpense)
                        <tr class="{{ ($recurringExpense->default_amount == 0) ? "bg-subtle-warning" : "" }}" id="recurringExpense_{{ $recurringExpense->id }}" data-recurring-expense-id="{{ $recurringExpense->id }}">
                            <td style="border-left: 4px solid transparent" title="{{ $recurringExpense->name }} - {{ __('recurring-expenses.uncategorized') }}"><a href="{{ route('family.recurring-expenses.edit', [$family, $recurringExpense, 'return' => url()->current()]) }}">{{ $recurringExpense->name }}</a></td>
                            <td class="text-right">{{ App\formatCurrency($recurringExpense->default_amount, true) }}</td>
                        </tr>
                    @endforeach

                    @foreach ($categories as $category)
                        @foreach ($recurringExpenses->where('category_id', $category->id) as $recurringExpense)
                            <tr class="{{ ($recurringExpense->default_amount == 0) ? "bg-subtle-warning" : "" }}" id="recurringExpense_{{ $recurringExpense->id }}" data-recurring-expense-id="{{ $recurringExpense->id }}">
                                <td style="border-left: 4px solid {{ $category->color }}" title="{{ $recurringExpense->name }} - {{ $category->name }}"><a href="{{ route('family.recurring-expenses.edit', [$family, $recurringExpense, 'return' => url()->current()]) }}">{{ $recurringExpense->name }}</a></td>
                                <td class="text-right">{{ App\formatCurrency($recurringExpense->default_amount, true) }}</td>
                            </tr>
                        @endforeach
                    @endforeach

                    <tr>
                        <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                        <td class="text-right"><strong>{{ App\formatCurrency($recurringExpenses->sum('default_amount'), true) }}</strong></td>
                    </tr>
                </table>

            </div>

            <div class="section">
                <h3>{{ __('expense-groups.expense-groups') }}</h3>

                <table class="table table-sm">
                    <caption>{{ __('expense-groups.expense-groups') }}</caption>
                    <thead>
                        <tr class="font-weight-bold">
                            <td>{{ __('expense-groups.name') }}</td>
                            <td class="text-right">{{ __('expense-groups.projected') }}</td>
                        </tr>
                    </thead>

                    @foreach ($expenseGroups->where('category_id', null) as $expenseGroup)

                        @php
                            $title = $expenseGroup->name . ' - ' . __('expense-groups.uncategorized');
                            $style = '';
                        @endphp

                        <tr>
                            <td title="{{ $title }}" style="{{ $style }}">
                                <a href="{{ route('family.expense-groups.edit', [$family, $expenseGroup, 'return' => url()->current()]) }}">
                                    {{ $expenseGroup->name }}
                                </a>
                                @if ($expenseGroup->cash)
                                    <span class="text-success fa fa-money ml-2 pt-1" title="{{ __('expense-groups.cash') }}"></span>
                                @endif
                            </td>
                            <td class="text-right">{{ App\formatCurrency($expenseGroup->default_amount, true) }}</td>
                        </tr>
                    @endforeach

                    @foreach ($categories as $category)
                        @foreach ($expenseGroups->where('category_id', $category->id) as $expenseGroup)
                            @php
                                $title = $expenseGroup->name . ' - ' . $category->name;
                                $style = 'border-left: 4px solid ' . $category->color . ';';
                            @endphp

                            <tr>
                                <td title="{{ $title }}" style="{{ $style }}">
                                    <a href="{{ route('family.expense-groups.edit', [$family, $expenseGroup, 'return' => url()->current()]) }}">
                                        {{ $expenseGroup->name }}
                                    </a>
                                    @if ($expenseGroup->cash)
                                        <span class="text-success fa fa-money ml-2 pt-1" title="{{ __('expense-groups.cash') }}"></span>
                                    @endif
                                </td>
                                <td class="text-right">{{ App\formatCurrency($expenseGroup->default_amount, true) }}</td>
                            </tr>

                        @endforeach
                    @endforeach

                    <tr class="font-weight-bold">
                        <td>{{ __('expense-groups.total') }}</td>
                        <td class="text-right">{{ App\formatCurrency($expenseGroups->sum('default_amount'), true) }}</td>
                    </tr>

                </table>

            </div>

            <hr>

            <div class="section">
                <h3>{{ __('cash-flow-plans.totals') }}</h3>

                <table class="table table-sm">
                    <caption>{{ __('cash-flow-plans.totals') }}</caption>

                    <tr>
                        <td>{{ __('income-sources.income-sources') }}</td>
                        <td class="text-right">{{ App\formatCurrency($incomeSources->sum('default_amount'), true) }}</td>
                        <td class="text-right">&nbsp;</td>
                    </tr>

                    <tr>
                        <td>{{ __('cash-flow-plans.lifestyle-expenses') }}</td>
                        <td class="text-right">&nbsp;</td>
                        <td class="text-right">{{ \App\formatCurrency($lifestyleExpensesTotal, true) }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('piggy-banks.piggy-banks') }}</td>
                        <td class="text-right">&nbsp;</td>
                        <td class="text-right">{{ \App\formatCurrency($piggyBanks->sum('monthly_contribution'), true) }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('recurring-expenses.recurring-expenses') }}</td>
                        <td class="text-right">&nbsp;</td>
                        <td class="text-right">{{ App\formatCurrency($recurringExpenses->sum('default_amount'), true) }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('expense-groups.expense-groups') }}</td>
                        <td class="text-right">&nbsp;</td>
                        <td class="text-right">{{ App\formatCurrency($expenseGroups->sum('default_amount'), true) }}</td>
                    </tr>

                    <tr class="font-weight-bold">
                        <td>{{ __('cash-flow-plans.totals') }}</td>
                        <td class="text-right">{{ App\formatCurrency($incomeSources->sum('default_amount'), true) }}</td>
                        <td class="text-right">{{ App\formatCurrency(
                                  $lifestyleExpensesTotal
                                + $piggyBanks->sum('monthly_contribution')
                                + $recurringExpenses->sum('default_amount')
                                + $expenseGroups->sum('default_amount')
                            , true) }}</td>
                    </tr>

                </table>

            </div>

            <p>{{ __('cash-flow-plans.create-plan-confirmation') }}</p>

            <form action="{{ route('family.cash-flow-plans.store-plan', [$family, $year, $month]) }}" method="POST">

                @csrf

                <button type="submit" class="btn btn-primary">
                    {{ __('cash-flow-plans.create-plan') }}
                </button>

                <a href="{{ route('family.cash-flow-plans.index', [$family]) }}" class="btn btn-secondary">{{ __('form.cancel') }}</a>

            </form>

        </div>

    </div>

@endsection
