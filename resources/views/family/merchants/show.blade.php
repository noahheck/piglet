@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('merchants.merchants') }} - {{ $merchant->name }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.merchants.index.js') }}"></script>
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family])   => __('money-matters.money-matters'),
            route('family.merchants.index', [$family]) => __('merchants.merchants'),
        ],
        'location'   => $merchant->name,
        'menu' => [
            ['type' => 'link', 'href' => route('family.merchants.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('merchants.add-new-merchant')],
            ['type' => 'link', 'href' => route('family.merchants.edit', [$family, $merchant]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'merchants'])

        </div>

        <div class="col-12 col-md-9">

            <div class="row">

                <div class="col-12 col-md-7">

                    <h2>{{ $merchant->name }}</h2>

                    @if ($merchant->defaultCategory)
                        <p><strong>{{ __('merchants.default-category') }}:</strong> {{ $merchant->defaultCategory->name }} {{ $merchant->default_sub_category ? ' - ' . $merchant->default_sub_category : '' }}</p>
                    @endif

                    <p>{{ $merchant->details }}</p>

                </div>

                <div class="col-12 col-md-5">

                    @if ($merchant->url || $merchant->phone || $merchant->secondaryPhone || $merchant->address)

                        <div class="card shadow">

                            <h5 class="card-header">{{ __('merchants.contact') }}</h5>

                            <div class="card-body">

                                <dl>
                                    @if ($merchant->url)
                                        <dt>{{ __('merchants.website') }}:</dt>
                                        <dd><a href="{{ $merchant->url }}" target="_blank">{{ $merchant->url }}</a></dd>
                                    @endif
                                    @if ($merchant->phone || $merchant->secondaryPhone)
                                        <dt>{{ __('merchants.phone') }}:</dt>
                                        <dd>{{ $merchant->phone }} {{ ($merchant->secondaryPhone) ? '|' : '' }} {{ $merchant->secondaryPhone }}</dd>
                                    @endif
                                    @if ($merchant->address)
                                        <dt>{{ __('merchants.address') }}:</dt>
                                        <dd>{!! nl2br(e($merchant->address)) !!}</dd>
                                    @endif
                                </dl>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

            <div class="row">

                <div class="col-12">

                    @if (count($yearOptions) > 1)
                        <div class="float-right">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="yearSelectMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Year
                                </button>
                                <div class="dropdown-menu" aria-labelledby="yearSelectMenuButton">
                                    @foreach ($yearOptions as $yearOption)
                                        <a class="dropdown-item" href="{{ route('family.merchants.show', [$family, $merchant, 'year' => $yearOption]) }}">{{ $yearOption }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <h4>{{ $year }} {{ __('merchants.monthly-expenses') }}</h4>

                    <canvas id="merchantMonthlyExpensesChart" class="piglet-chart" data-chart-data='@json($merchant->monthlyExpensesChartData($year))'></canvas>

                    <table class="table table-sm">
                        <caption>{{ __('merchants.merchant') }} {{ __('expenses.expenses') }}</caption>

                        <thead>
                            <tr class="font-weight-bold">
                                <td>{{ __('expenses.date') }}</td>
                                <td class="text-right">{{ __('expenses.projected') }}</td>
                                <td class="text-right">{{ __('expenses.actual') }}</td>
                            </tr>
                        </thead>

                        @foreach ($merchant->expensesByYear($year) as $monthlyExpenses)

                            @foreach ($monthlyExpenses as $expense)
                                @php
                                    $href = '';

                                    if (is_a($expense, '\App\Family\CashFlowPlan\Expense')) {
                                        $href = route('family.cash-flow-plans.expenses.edit', [$family, $expense->cash_flow_plan_id, $expense]);
                                    } elseif (is_a($expense, '\App\Family\CashFlowPlan\RecurringExpense')) {
                                        $href = route('family.cash-flow-plans.recurring-expenses.edit', [$family, $expense->cash_flow_plan_id, $expense]);
                                    }

                                @endphp
                                <tr>
                                    <td><a href="{{ $href }}">{{ ($expense->date) ? \App\formatDate($expense->date) : '<no date>' }}</a></td>
                                    <td class="text-right">{{ \App\formatCurrency($expense->projected, true) }}</td>
                                    <td class="text-right">{{ \App\formatCurrency($expense->actual, true) }}</td>
                                </tr>
                            @endforeach

                        @endforeach

                    </table>

                </div>

            </div>

        <hr>



        </div>

    </div>

@endsection
