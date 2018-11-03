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

            {{-- Beginning of summary section --}}
            <div class="section mt-5 mt-md-0">


                <h2>{{ __('months.' . $cashFlowPlan->month) }} {{ $cashFlowPlan->year }}</h2>
                <p>{!! nl2br(__($cashFlowPlan->details)) !!}</p>

                <div class="row mb-3">

                    <div class="col col-sm-6 order-1 order-sm-2">

                        <canvas id="cfpBalanceChart" class="piglet-chart" data-chart-data='@json($cashFlowPlan->balanceChartData())'></canvas>

                    </div>

                    <div class="col col-sm-6 order-2 order-sm-1">

                        <ul class="list-group shadow-sm">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold">{{ __('cash-flow-plans.income') }}</span>
                                <span>{{ App\formatCurrency($cashFlowPlan->actualIncomeSourcesTotal(), true) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold">{{ __('cash-flow-plans.expenditures') }}</span>
                                <span>
                                {{ App\formatCurrency($cashFlowPlan->allExpendituresTotal(), true) }}
                            </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold">{{ __('cash-flow-plans.balance') }}</span>
                                <span>
                                {{ App\formatCurrency($cashFlowPlan->balance(), true) }}
                            </span>
                            </li>
                        </ul>

                    </div>

                </div>



                <canvas id="cfpSummaryChart" class="piglet-chart" data-chart-data='@json($cashFlowPlan->summaryChartData())'></canvas>

            </div>
            {{-- End of summary section --}}



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


            {{-- Beginning of set expenses section --}}

                <div class="section">

                    <h3>{{ __('cash-flow-plans.lifestyle-expenses') }}</h3>

                    <div class="row">

                        <div class="col-12 col-lg-6">

                            <div class="card shadow-sm mb-3 investment">

                                <div class="card-body">

                                    <h4 class="text-center">{{ __('cash-flow-plans.pocket-money') }}</h4>

                                    <h5 class="text-center">
                                        {{ \App\formatCurrency($cashFlowPlan->pocket_money, true) }}
                                        @if ($cashFlowPlan->pocket_money_distributed)
                                            <span class="text-success fa fa-check-circle-o"></span>
                                        @endif
                                    </h5>

                                </div>

                            </div>

                        </div>

                    </div>

                    <h4>
                        {{ __('cash-flow-plans.investments') }}
                    </h4>

                    <div class="row">

                        @foreach (['retirement', 'education',] as $investment)

                            @include('family.cash-flow-plans._savings', [
                                'family'       => $family,
                                'cashFlowPlan' => $cashFlowPlan,
                                'investment'   => $investment,
                            ])

                        @endforeach

                    </div>

                    <div class="text-right">
                        <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.lifestyle-expenses', [$family, $cashFlowPlan]) }}">{{ __('cash-flow-plans.edit-lifestyle-expenses') }}</a>
                    </div>

            </div>
            {{-- End of saving section --}}



            {{-- Beginning of Piggy Banks section --}}
            <div class="section">

                <h3>
                    <a href="{{ route('family.cash-flow-plans.piggy-banks.index', [$family, $cashFlowPlan]) }}">{{ __('piggy-banks.piggy-banks') }}</a>
                </h3>

                <div class="row">

                    @foreach ($cashFlowPlan->piggyBanks as $piggyBank)

                        @include('family.cash-flow-plans._piggy-bank', [
                            'family'       => $family,
                            'cashFlowPlan' => $cashFlowPlan,
                            'piggyBank'    => $piggyBank,
                        ])

                    @endforeach

                </div>

                <div class="text-right">
                    <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.piggy-banks.create', [$family, $cashFlowPlan]) }}">{{ __('piggy-banks.add-new-piggy-bank') }}</a>
                </div>

            </div>
            {{-- End of Piggy Banks section --}}



            {{-- Beginning of Recurring Expenses section --}}
            <div class="section">

                <h3>
                    <a href="{{ route('family.cash-flow-plans.recurring-expenses.index', [$family, $cashFlowPlan]) }}">{{ __('recurring-expenses.recurring-expenses') }}</a>
                </h3>

                <div class="row">

                    @if ($cashFlowPlan->hasRecurringExpensesForCategory(null))

                        @include('family.cash-flow-plans._recurring-expense-category', [
                            'family'       => $family,
                            'cashFlowPlan' => $cashFlowPlan,
                            'categoryId'   => null,
                            'categoryName' => __('recurring-expenses.uncategorized'),
                            'borderColor'  => '#999'
                        ])

                    @endif

                    @foreach ($categories as $category)

                        @continue(!$cashFlowPlan->hasRecurringExpensesForCategory($category->id))

                        @include('family.cash-flow-plans._recurring-expense-category', [
                            'family'       => $family,
                            'cashFlowPlan' => $cashFlowPlan,
                            'categoryId'   => $category->id,
                            'categoryName' => $category->name,
                            'borderColor'  => $category->color,
                        ])

                    @endforeach

                </div>

                <div class="text-right">
                    <a class="btn btn-outline-primary" href="{{ route('family.cash-flow-plans.recurring-expenses.create', [$family, $cashFlowPlan, 'return' => url()->current()]) }}">{{ __('recurring-expenses.add-new-recurring-expense') }}</a>
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
                                    @if ($expenseGroup->cash)
                                        <span class="float-right text-success fa fa-money mr-2 pt-1" title="{{ __('expense-groups.cash') }}"></span>
                                    @endif

                                    <h3>
                                        {{ $expenseGroup->name }}
                                    </h3>

                                    <p class="text-dark card-text">
                                        <small class="text-muted float-right" title="{{ __('cash-flow-plans.actual-vs-projected') }}">
                                            {{ App\formatCurrency($expenseGroup->actualVsProjected(), true) }}
                                        </small>
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

                                <a class="card-footer text-center" href="{{ route('family.cash-flow-plans.expenses.create', [$family, $cashFlowPlan, 'expense_group_id' => $expenseGroup->id]) }}">
                                    <span class="fa fa-dollar"></span> {{ __('expenses.add-new-expense') }}
                                </a>

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

@endsection
