@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) }} {{ $cashFlowPlan->year }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.cash-flow-plans.show.css') }}" />
@endpush

@push('scripts')
{{--    <script type="text/javascript" src="{{ asset('js/family.categories.index.js') }}"></script>--}}
@endpush


@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.cash-flow-plans.index', [$family]) => __('cash-flow-plans.cash-flow-plans'),
        ],
        'location'   => __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year,
        'menu' => [
            ['type' => 'link', 'href' => route('family.cash-flow-plans.income-sources.create', [$family, $cashFlowPlan, 'return' => url()->current()]), 'icon' => 'fa fa-money', 'text' => __('income-sources.add-new-income-source')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.recurring-expenses.create', [$family, $cashFlowPlan, 'return' => url()->current()]), 'icon' => 'fa fa-refresh', 'text' => __('recurring-expenses.add-new-recurring-expense')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.expense-groups.create', [$family, $cashFlowPlan, 'return' => url()->current()]), 'icon' => 'fa fa-folder-open-o', 'text' => __('expense-groups.add-new-expense-group')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.expenses.create', [$family, $cashFlowPlan, 'return' => url()->current()]), 'icon' => 'fa fa-plus-circle', 'text' => __('expenses.add-new-expense')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('months.' . $cashFlowPlan->month) }} {{ $cashFlowPlan->year }}</h2>

            <ul class="nav nav-tabs" id="budgetTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="overviewTab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">{{ __('cash-flow-plans.overview') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">{{ __('cash-flow-plans.details') }}</a>
                </li>
            </ul>


            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overviewTab">

                    <div class="section">

                        <h3>{{ __('cash-flow-plans.overview') }}</h3>

                        <table class="table table-sm">
                            <caption>{{ __('cash-flow-plans.overview') }}</caption>
                            <thead>
                                <tr class="font-weight-bold">
                                    <td>&nbsp;</td>
                                    <td class="text-right">{{ __('cash-flow-plans.projected') }}</td>
                                    <td class="text-right">{{ __('cash-flow-plans.actual') }}</td>
                                </tr>
                            </thead>

                            <tr>
                                <td>{{ __('income-sources.income-sources') }}</td>
                                <td class="text-right">{{ Auth::user()->formatCurrency($cashFlowPlan->projectedIncomeSourcesTotal(), true) }}</td>
                                <td class="text-right">{{ Auth::user()->formatCurrency($cashFlowPlan->actualIncomeSourcesTotal(), true) }}</td>
                            </tr>

                            <tr>
                                <td>{{ __('recurring-expenses.recurring-expenses') }}</td>
                                <td class="text-right">{{ Auth::user()->formatCurrency($cashFlowPlan->projectedRecurringExpensesTotal(), true) }}</td>
                                <td class="text-right">{{ Auth::user()->formatCurrency($cashFlowPlan->actualRecurringExpensesTotal(), true) }}</td>
                            </tr>

                        </table>

                    </div>

                </div>



                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="detailsTab">

                    <div id="incomeSources" class="section">

                        <h3>
                            <a href="{{ route('family.cash-flow-plans.income-sources.index', [$family, $cashFlowPlan]) }}">{{ __('income-sources.income-sources') }}</a>
                        </h3>

                        <table class="table table-sm">
                            <caption>{{ __('income-sources.income-sources') }}</caption>
                            <thead>
                                <tr class="font-weight-bold">
                                    <td class="text-center">{{ __('income-sources.name') }}</td>
                                    <td class="text-right">{{ __('income-sources.projected') }}</td>
                                    <td class="text-right">{{ __('income-sources.actual') }}</td>
                                </tr>
                            </thead>
                            @foreach ($cashFlowPlan->incomeSources as $incomeSource)
                                <tr>
                                    <td><a href="{{ route('family.cash-flow-plans.income-sources.edit', [$family, $cashFlowPlan, $incomeSource, 'return' => url()->current()]) }}">{{ $incomeSource->name }}</a></td>
                                    <td class="text-right">{{ Auth::user()->formatCurrency($incomeSource->projected, true) }}</td>
                                    <td class="text-right">{{ Auth::user()->formatCurrency($incomeSource->actual, true) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                                <td class="text-right"><strong>{{ Auth::user()->formatCurrency($cashFlowPlan->projectedIncomeSourcesTotal(), true) }}</strong></td>
                                <td class="text-right"><strong>{{ Auth::user()->formatCurrency($cashFlowPlan->actualIncomeSourcesTotal(), true) }}</strong></td>
                            </tr>
                        </table>

                        <div class="text-right">
                            <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.income-sources.create', [$family, $cashFlowPlan, 'return' => url()->current()]) }}">{{ __('income-sources.add-new-income-source') }}</a>
                        </div>

                    </div>



                    <div id="recurringExpenses" class="section">
                        <h3>
                            <a href="{{ route('family.cash-flow-plans.recurring-expenses.index', [$family, $cashFlowPlan]) }}">{{ __('recurring-expenses.recurring-expenses') }}</a>
                        </h3>

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
                                    <td style="border-left: 4px solid transparent" title="{{ $recurringExpense->name }} - {{ __('recurring-expenses.uncategorized') }}"><a href="{{ route('family.cash-flow-plans.recurring-expenses.edit', [$family, $cashFlowPlan, $recurringExpense, 'return' => url()->current()]) }}">{{ $recurringExpense->name }}</a></td>
                                    <td class="text-right">{{ Auth::user()->formatCurrency($recurringExpense->projected, true) }}</td>
                                    <td class="text-right">{{ Auth::user()->formatCurrency($recurringExpense->actual, true) }}</td>
                                </tr>
                            @endforeach

                            @foreach ($categories as $category)
                                @foreach ($recurringExpenses->where('category_id', $category->id) as $recurringExpense)
                                    <tr id="recurringExpense_{{ $recurringExpense->id }}" data-recurring-expense-id="{{ $recurringExpense->id }}">
                                        <td style="border-left: 4px solid {{ $category->color }}" title="{{ $recurringExpense->name }} - {{ $category->name }}"><a href="{{ route('family.cash-flow-plans.recurring-expenses.edit', [$family, $cashFlowPlan, $recurringExpense, 'return' => url()->current()]) }}">{{ $recurringExpense->name }}</a></td>
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

                        <div class="text-right">
                            <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.recurring-expenses.create', [$family, $cashFlowPlan, 'return' => url()->current()]) }}">{{ __('recurring-expenses.add-new-recurring-expense') }}</a>
                        </div>

                    </div>

                    <hr>

                    <h2>Expenses</h2>

                    @foreach ($cashFlowPlan->expenseGroups as $expenseGroup)

                        <div class="section">
                            <h3>
                                <a href="{{ route('family.cash-flow-plans.expense-groups.edit', [$family, $cashFlowPlan, $expenseGroup, 'return' => url()->current()]) }}">{{ $expenseGroup->name }}</a>
                                <small class="float-right">{{ Auth::user()->formatCurrency($expenseGroup->projected, true) }}</small>
                            </h3>

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
                                        <td><a href="{{ route('family.cash-flow-plans.expenses.edit', [$family, $cashFlowPlan, $expense, 'return' => url()->current()]) }}">{{ ($expense->merchant) ? $expense->merchant->name : __('expenses.no-merchant') }}</a></td>
                                        <td class="text-right">{{ ($expense->projected) ? Auth::user()->formatCurrency($expense->projected, true) : '' }}</td>
                                        <td class="text-right">{{ ($expense->actual) ? Auth::user()->formatCurrency($expense->actual, true) : '' }}</td>
                                    </tr>
                                @endforeach

                                @foreach ($categories as $category)
                                    @foreach ($expenseGroup->expenses->where('category_id', $category->id) as $expense)
                                        <tr>
                                            <td style="border-left: 4px solid {{ $category->color }}" title="{{ $category->name }}">{{ Auth::user()->formatDate($expense->date) }}</td>
                                            <td><a href="{{ route('family.cash-flow-plans.expenses.edit', [$family, $cashFlowPlan, $expense, 'return' => url()->current()]) }}">{{ ($expense->merchant) ? $expense->merchant->name : __('expenses.no-merchant') }}</a></td>
                                            <td class="text-right">{{ ($expense->projected) ? Auth::user()->formatCurrency($expense->projected, true) : '' }}</td>
                                            <td class="text-right">{{ ($expense->actual) ? Auth::user()->formatCurrency($expense->actual, true) : '' }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach

                                <tr>
                                    <td colspan="2"><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                                    <td class="text-right"><strong>{{ Auth::user()->formatCurrency($expenseGroup->expenses->sum('projected'), true) }}</strong></td>
                                    <td class="text-right"><strong>{{ Auth::user()->formatCurrency($expenseGroup->expenses->sum('actual'), true) }}</strong></td>
                                </tr>

                            </table>

                            <div class="text-right">
                                <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.expenses.create', [$family, $cashFlowPlan, 'return' => url()->current(), 'expense_group_id' => $expenseGroup->id]) }}">{{ __('expenses.add-new-expense') }}</a>
                            </div>
                        </div>

                    @endforeach

                    <div class="text-right">
                        <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.expense-groups.create', [$family, $cashFlowPlan, 'return' => url()->current()]) }}">{{ __('expense-groups.add-new-expense-group') }}</a>
                    </div>

                    <hr>

                    <div class="section">

                        <h3>
                            <a href="{{ route('family.cash-flow-plans.expenses.index', [$family, $cashFlowPlan]) }}">Other Expenses</a>
                        </h3>

                        <table class="table table-sm">
                            <caption>Other Expenses</caption>
                            <thead>
                                <tr class="font-weight-bold">
                                    <td>{{ __('expenses.date') }}</td>
                                    <td>{{ __('expenses.merchant') }}</td>
                                    <td class="text-right">{{ __('expenses.projected') }}</td>
                                    <td class="text-right">{{ __('expenses.actual') }}</td>
                                </tr>
                            </thead>

                            @php
                                $nonGroupedExpenses = $cashFlowPlan->expenses->where('expense_group_id', null);
                            @endphp

                            @foreach ($nonGroupedExpenses->where('category_id', null) as $expense)
                                @php
                                    $link = route('family.cash-flow-plans.expenses.edit', [$family, $cashFlowPlan, $expense, 'return' => url()->current()]);
                                @endphp
                                <tr>
                                    <td style="border-left: 4px solid transparent"><a href="{{ $link }}">{{ Auth::user()->formatDate($expense->date) }}</a></td>
                                    <td><a href="{{ $link }}">{{ ($expense->merchant) ? $expense->merchant->name : __('expenses.no-merchant') }}</a></td>
                                    <td class="text-right">{{ ($expense->projected) ? Auth::user()->formatCurrency($expense->projected, true) : '' }}</td>
                                    <td class="text-right">{{ ($expense->actual) ? Auth::user()->formatCurrency($expense->actual, true) : '' }}</td>
                                </tr>
                            @endforeach

                            @foreach ($categories as $category)
                                @foreach ($nonGroupedExpenses->where('category_id', $category->id) as $expense)
                                    @php
                                        $link = route('family.cash-flow-plans.expenses.edit', [$family, $cashFlowPlan, $expense, 'return' => url()->current()]);
                                    @endphp
                                    <tr>
                                        <td style="border-left: 4px solid {{ $category->color }}" title="{{ $category->name }}"><a href="{{ $link }}">{{ Auth::user()->formatDate($expense->date) }}</a></td>
                                        <td><a href="{{ $link }}">{{ ($expense->merchant) ? $expense->merchant->name : __('expenses.no-merchant') }}</a></td>
                                        <td class="text-right">{{ ($expense->projected) ? Auth::user()->formatCurrency($expense->projected, true) : '' }}</td>
                                        <td class="text-right">{{ ($expense->actual) ? Auth::user()->formatCurrency($expense->actual, true) : '' }}</td>
                                    </tr>
                                @endforeach
                            @endforeach

                            <tr>
                                <td colspan="2"><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                                <td class="text-right"><strong>{{ Auth::user()->formatCurrency($nonGroupedExpenses->sum('projected'), true) }}</strong></td>
                                <td class="text-right"><strong>{{ Auth::user()->formatCurrency($nonGroupedExpenses->sum('actual'), true) }}</strong></td>
                            </tr>

                        </table>

                        <div class="text-right">
                            <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.expenses.create', [$family, $cashFlowPlan, 'return' => url()->current()]) }}">{{ __('expenses.add-new-expense') }}</a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
