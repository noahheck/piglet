@extends('layouts.print')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) }} {{ $cashFlowPlan->year }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.cash-flow-plans.show.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/family.cash-flow-plans.show.js') }}"></script>
@endpush

@push('meta')
    @meta('cash-flow-plan-id', $cashFlowPlan->id)
@endpush

@section('print-options')

@endsection

@section('content')

    <h1>{{ __('months.' . $cashFlowPlan->month) }} {{ $cashFlowPlan->year }}</h1>
    <p>{!! nl2br(e($cashFlowPlan->details)) !!}</p>

    <hr>

    <h4>{{ __('cash-flow-plans.projected') }}</h4>

    <div class="row mb-3">

        <div class="col-6">

            <ul class="list-group shadow-sm">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="font-weight-bold">{{ __('cash-flow-plans.income') }}</span>
                    <span>{{ App\formatCurrency($cashFlowPlan->projectedIncomeSourcesTotal(), true) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="font-weight-bold">{{ __('cash-flow-plans.expenditures') }}</span>
                    <span>
                        {{ App\formatCurrency($cashFlowPlan->allProjectedExpendituresTotal(), true) }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="font-weight-bold">{{ __('cash-flow-plans.balance') }}</span>
                    <span>
                        {{ App\formatCurrency($cashFlowPlan->projectedBalance(), true) }}
                    </span>
                </li>
            </ul>

        </div>

        <div class="col-6">

            <canvas id="cfpBalanceChart" class="piglet-chart" data-chart-data='@json($cashFlowPlan->projectedBalanceChartData())'></canvas>

        </div>

    </div>

    <hr>

    <h4>{{ __('cash-flow-plans.actual') }}</h4>

    <div class="row mb-3">

        <div class="col col-sm-6 order-1 order-sm-2">

            <canvas id="cfpBalanceChart" class="piglet-chart" data-chart-data='@json($cashFlowPlan->actualBalanceChartData())'></canvas>

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

    <hr>

    <canvas id="cfpSummaryChart" class="piglet-chart" data-chart-data='@json($cashFlowPlan->summaryChartData())'></canvas>

    <hr>

    {{-- Beginning of income sources section --}}
    <h3>{{ __('income-sources.income-sources') }}</h3>

    <table class="table table-sm">
        <caption class="sr-onlysss">{{ __('income-sources.income-sources') }}</caption>
        <thead>
        <tr class="font-weight-bold">
            <td class="text-center">{{ __('income-sources.name') }}</td>
            <td class="text-right">{{ __('income-sources.projected') }}</td>
            <td class="text-right">{{ __('income-sources.actual') }}</td>
        </tr>
        </thead>
        @foreach ($cashFlowPlan->incomeSources as $incomeSource)
            <tr>
                <td>{{ $incomeSource->name }}</td>
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

    <hr>
    {{-- End of income sources section --}}


    {{-- Beginning of lifestyle expenses section --}}
    <h3>{{ __('cash-flow-plans.lifestyle-expenses') }}</h3>

    <table class="table table-sm">
        <caption class="sr-onlysss">{{ __('cash-flow-plans.lifestyle-expenses') }}</caption>
        <thead>
        <tr class="font-weight-bold">
            <td class="text-center">&nbsp;</td>
            <td class="text-right">{{ __('income-sources.projected') }}</td>
            <td class="text-right">{{ __('income-sources.actual') }}</td>
        </tr>
        </thead>
        <tr>
            <td>{{ __('cash-flow-plans.pocket-money') }}</td>
            <td class="text-right">{{ \App\formatCurrency($cashFlowPlan->pocket_money, true) }}</td>
            <td class="text-right">{{ App\formatCurrency(($cashFlowPlan->pocket_money_distributed) ? $cashFlowPlan->pocket_money : 0, true) }}</td>
        </tr>
        <tr>
            <td>{{ __('cash-flow-plans.retirement') }}</td>
            <td class="text-right">{{ \App\formatCurrency($cashFlowPlan->retirement, true) }}</td>
            <td class="text-right">{{ App\formatCurrency(($cashFlowPlan->retirement_distributed) ? $cashFlowPlan->retirement : 0, true) }}</td>
        </tr>
        <tr>
            <td>{{ __('cash-flow-plans.education') }}</td>
            <td class="text-right">{{ \App\formatCurrency($cashFlowPlan->education, true) }}</td>
            <td class="text-right">{{ App\formatCurrency(($cashFlowPlan->education_distributed) ? $cashFlowPlan->education : 0, true) }}</td>
        </tr>

        <tr>
            <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
            <td class="text-right"><strong>{{ App\formatCurrency($cashFlowPlan->projectedLifestyleExpensesTotal(), true) }}</strong></td>
            <td class="text-right"><strong>{{ App\formatCurrency($cashFlowPlan->distributedLifeStyleExpensesTotal(), true) }}</strong></td>
        </tr>
    </table>

    <hr>
    {{-- End of lifestyle expenses section --}}



    {{-- Beginning of Piggy Banks section --}}
    <h3>{{ __('piggy-banks.piggy-banks') }}</h3>

    <table class="table table-sm">
        <caption class="sr-onlysss">{{ __('piggy-banks.piggy-banks') }}</caption>
        <thead>
        <tr class="font-weight-bold">
            <td class="text-center">&nbsp;</td>
            <td class="text-right">{{ __('piggy-banks.projected') }}</td>
            <td class="text-right">{{ __('piggy-banks.actual') }}</td>
        </tr>
        </thead>

        @foreach ($cashFlowPlan->piggyBanks as $piggyBank)
            <tr>
                <td>{{ $piggyBank->name }}</td>
                <td class="text-right">{{ \App\formatCurrency($piggyBank->projected, true) }}</td>
                <td class="text-right">{{ App\formatCurrency(($piggyBank->actualTotal()), true) }}</td>
            </tr>
        @endforeach

        <tr>
            <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
            <td class="text-right"><strong>{{ App\formatCurrency($cashFlowPlan->projectedPiggyBankTotal(), true) }}</strong></td>
            <td class="text-right"><strong>{{ App\formatCurrency($cashFlowPlan->actualPiggyBankContributionsTotal(), true) }}</strong></td>
        </tr>
    </table>

    {{-- End of Piggy Banks section --}}

@endsection
