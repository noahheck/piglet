@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) }} {{ $cashFlowPlan->year }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.cash-flow-plans.show.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.cash-flow-plans.show.js') }}"></script>
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
            ['type' => 'link', 'href' => route('family.cash-flow-plans.expenses.create', [$family, $cashFlowPlan, 'return' => url()->current()]), 'icon' => 'fa fa-dollar', 'text' => __('expenses.add-new-expense')],
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

                <div class="tab-pane show active" id="overview" role="tabpanel" aria-labelledby="overviewTab">

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
                                <td class="text-right">{{ App\formatCurrency($cashFlowPlan->projectedIncomeSourcesTotal(), true) }}</td>
                                <td class="text-right">{{ App\formatCurrency($cashFlowPlan->actualIncomeSourcesTotal(), true) }}</td>
                            </tr>

                            @php
                                $statusClass = '';
                                $srText      = '';

                                if ($cashFlowPlan->recurringExpensesOverspent()) {
                                    $statusClass = 'text-danger';
                                    $srText      = __('cash-flow-plans.overspent');
                                } elseif ($cashFlowPlan->recurringExpensesCloseToOverspent()) {
                                    $statusClass = 'text-warning';
                                    $srText      = __('cash-flow-plans.almost-overspent');
                                }

                            @endphp

                            <tr class="{{ $statusClass }}">
                                <td>{{ __('recurring-expenses.recurring-expenses') }} <span class="sr-only">{{ $srText }}</span></td>
                                <td class="text-right">{{ App\formatCurrency($cashFlowPlan->projectedRecurringExpensesTotal(), true) }}</td>
                                <td class="text-right">{{ App\formatCurrency($cashFlowPlan->actualRecurringExpensesTotal(), true) }}</td>
                            </tr>

                            @foreach ($cashFlowPlan->expenseGroups as $expenseGroup)

                                @php
                                    $statusClass = '';
                                    $srText      = '';

                                    if ($expenseGroup->isOverspent()) {
                                        $statusClass = 'bg-danger text-white';
                                        $srText      = __('cash-flow-plans.overspent');
                                    } elseif ($expenseGroup->isCloseToOverspent()) {
                                        $statusClass = 'bg-warning';
                                        $srText      = __('cash-flow-plans.almost-overspent');
                                    }

                                @endphp

                                <tr class="{{ $statusClass }}">
                                    <td>{{ $expenseGroup->name }} <span class="sr-only">{{ $srText }}</span></td>
                                    <td class="text-right">{{ App\formatCurrency($expenseGroup->projected, true) }}</td>
                                    <td class="text-right">{{ App\formatCurrency($expenseGroup->actualTotal(), true) }}</td>
                                </tr>
                            @endforeach

                        </table>

                    </div>

                </div>



                <div class="tab-pane" id="details" role="tabpanel" aria-labelledby="detailsTab">


                    {{-- Beginning of Income Sources section --}}
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
                                    <td class="text-right">{{ App\formatCurrency($incomeSource->projected, true) }}</td>
                                    <td class="text-right">{{ App\formatCurrency($incomeSource->actual, true) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                                <td class="text-right"><strong>{{ App\formatCurrency($cashFlowPlan->projectedIncomeSourcesTotal(), true) }}</strong></td>
                                <td class="text-right"><strong>{{ App\formatCurrency($cashFlowPlan->actualIncomeSourcesTotal(), true) }}</strong></td>
                            </tr>
                        </table>

                        <div class="text-right">
                            <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.income-sources.create', [$family, $cashFlowPlan, 'return' => url()->current()]) }}">{{ __('income-sources.add-new-income-source') }}</a>
                        </div>

                    </div>
                    {{-- End of Income Sources section --}}



                    {{-- Beginning of Piggy Bank Contributions section --}}
                    <div class="section">

                        <h3>
                            <a href="{{ route('family.cash-flow-plans.piggy-bank-contributions.index', [$family, $cashFlowPlan]) }}">{{ __('piggy-banks.piggy-bank-contributions') }}</a>
                        </h3>

                        <table class="table table-sm">
                            <caption>{{ __('piggy-banks.piggy-bank-contributions') }}</caption>
                            <thead>
                            <tr class="font-weight-bold">
                                <td class="text-center">&nbsp;</td>
                                <td class="text-right">{{ __('piggy-banks.projected') }}</td>
                                <td class="text-right">{{ __('piggy-banks.actual') }}</td>
                            </tr>
                            </thead>
                            @foreach ($cashFlowPlan->piggyBankContributions as $contribution)
                                <tr>
                                    <td><a href="{{ route('family.cash-flow-plans.piggy-bank-contributions.edit', [$family, $cashFlowPlan, $contribution]) }}">{{ $contribution->title() }}</a></td>
                                    <td class="text-right">{{ App\formatCurrency($contribution->projected, true) }}</td>
                                    <td class="text-right">{{ App\formatCurrency($contribution->actual, true) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                                <td class="text-right"><strong>{{ App\formatCurrency($cashFlowPlan->projectedPiggyBankContributionsTotal(), true) }}</strong></td>
                                <td class="text-right"><strong>{{ App\formatCurrency($cashFlowPlan->actualPiggyBankContributionsTotal(), true) }}</strong></td>
                            </tr>
                        </table>

                        <div class="text-right">
                            <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.piggy-bank-contributions.create', [$family, $cashFlowPlan]) }}">{{ __('piggy-banks.add-new-contribution') }}</a>
                        </div>

                    </div>
                    {{-- End of Piggy Bank Contributions section --}}




                    {{-- Beginning of Recurring Expenses section --}}
                    <div class="section">

                        <h3>
                            <a href="{{ route('family.cash-flow-plans.recurring-expenses.index', [$family, $cashFlowPlan]) }}">{{ __('recurring-expenses.recurring-expenses') }}</a>
                        </h3>

                        <div class="row">

                            @if ($cashFlowPlan->hasRecurringExpensesForCategory(null))

                                @include('family.shared.cash-flow-plans.recurring-expense-category', [
                                    'family'       => $family,
                                    'cashFlowPlan' => $cashFlowPlan,
                                    'categoryId'   => null,
                                    'categoryName' => __('recurring-expenses.uncategorized'),
                                    'borderColor'  => '#999'
                                ])

                            @endif

                            @foreach ($categories as $category)

                                @continue(!$cashFlowPlan->hasRecurringExpensesForCategory($category->id))

                                @include('family.shared.cash-flow-plans.recurring-expense-category', [
                                    'family'       => $family,
                                    'cashFlowPlan' => $cashFlowPlan,
                                    'categoryId'   => $category->id,
                                    'categoryName' => $category->name,
                                    'borderColor'  => $category->color,
                                ])

                            @endforeach

                        </div>

                    </div>
                    {{-- End of Recurring Expenses section --}}



                    {{-- Beginning of Expense Groups section --}}
                    <div class="section">

                        <h3>
                            <a href="{{ route('family.cash-flow-plans.expense-groups.index', [$family, $cashFlowPlan]) }}">Expenses</a>
                        </h3>

                        <div class="row">

                            @foreach ($cashFlowPlan->expenseGroups as $expenseGroup)

                                <div class="col-12 col-lg-6">
                                    <div class="card shadow-sm mb-5 expense-group" style="border-top: 3px solid {{ $expenseGroup->category ? $expenseGroup->category->color : '' }}">

                                        <a class="card-body" href="{{ route('family.cash-flow-plans.expense-groups.show', [$family, $cashFlowPlan, $expenseGroup, 'return' => url()->current()]) }}">

                                            @if ($expenseGroup->category)
                                                <span class="text-muted float-right">{{ $expenseGroup->category->name }}</span>
                                            @endif

                                            <h3>
                                                {{ $expenseGroup->name }}
                                            </h3>

                                            <p class="text-dark card-text">
                                                {{ App\formatCurrency($expenseGroup->actualTotal(), true) }} / {{ App\formatCurrency($expenseGroup->projected, true) }}
                                            </p>

                                            <div class="progress">

                                                @php
                                                    $statusClass = '';
                                                    if ($expenseGroup->isOverspent()) {
                                                        $statusClass = 'bg-danger';
                                                    } elseif ($expenseGroup->isCloseToOverspent()) {
                                                        $statusClass = 'bg-warning';
                                                    }
                                                @endphp

                                                <div class="progress-bar {{ $statusClass }}" role="progressbar" style="width: {{ $expenseGroup->percentUtilized() }}%" aria-valuenow="{{ $expenseGroup->actualTotal() }}" aria-valuemin="0" aria-valuemax="{{ App\formatCurrency($expenseGroup->projected, false) }}"></div>
                                            </div>

                                        </a>

                                        <div class="card-footer p0">

                                            <div class="row">

                                                <a class="col text-center" href="{{ route('family.cash-flow-plans.expense-groups.edit', [$family, $cashFlowPlan, $expenseGroup]) }}">
                                                    <span class="fa fa-edit"></span> {{ __('form.edit') }}
                                                </a>

                                                <a class="col text-center border-left" href="{{ route('family.cash-flow-plans.expenses.create', [$family, $cashFlowPlan, 'return' => url()->current(), 'expense_group_id' => $expenseGroup->id]) }}">
                                                    <span class="fa fa-dollar"></span> {{ __('expenses.add-new-expense') }}
                                                </a>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                            @endforeach

                        </div>

                        <div class="text-right">
                            <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.expense-groups.create', [$family, $cashFlowPlan, 'return' => url()->current()]) }}">{{ __('expense-groups.add-new-expense-group') }}</a>
                        </div>

                    </div>
                    {{-- End of Expense Groups section --}}



                </div>

            </div>

        </div>

    </div>

@endsection
