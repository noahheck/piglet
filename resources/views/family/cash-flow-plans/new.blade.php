@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('form.create') }} - {{ __('months.' . $month) }} {{ $year }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.cash-flow-plans.create.css') }}" />
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
                        <td class="text-center">{{ __('income-sources.name') }}</td>
                        <td class="text-right">{{ __('income-sources.projected') }}</td>
                    </tr>
                    </thead>
                    @foreach ($incomeSources as $incomeSource)
                        <tr>
                            <td><a href="{{ route('family.income-sources.edit', [$family, $incomeSource, 'return' => url()->current()]) }}">{{ $incomeSource->name }}</a></td>
                            <td class="text-right">{{ Auth::user()->formatCurrency($incomeSource->default_amount, true) }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                        <td class="text-right"><strong>{{ Auth::user()->formatCurrency($incomeSources->sum('default_amount'), true) }}</strong></td>
                    </tr>
                </table>

            </div>

            <div class="section">
                <h3>{{ __('recurring-expenses.recurring-expenses') }}</h3>

                <table class="table table-sm">
                    <caption>{{ __('recurring-expenses.recurring-expenses') }}</caption>
                    <thead>
                    <tr class="font-weight-bold">
                        <td class="text-center">{{ __('recurring-expenses.name') }}</td>
                        <td class="text-right">{{ __('recurring-expenses.projected') }}</td>
                    </tr>
                    </thead>

                    @foreach ($recurringExpenses->where('category_id', null) as $recurringExpense)
                        <tr id="recurringExpense_{{ $recurringExpense->id }}" data-recurring-expense-id="{{ $recurringExpense->id }}">
                            <td style="border-left: 4px solid transparent" title="{{ $recurringExpense->name }} - {{ __('recurring-expenses.uncategorized') }}"><a href="{{ route('family.recurring-expenses.edit', [$family, $recurringExpense, 'return' => url()->current()]) }}">{{ $recurringExpense->name }}</a></td>
                            <td class="text-right">{{ Auth::user()->formatCurrency($recurringExpense->default_amount, true) }}</td>
                        </tr>
                    @endforeach

                    @foreach ($categories as $category)
                        @foreach ($recurringExpenses->where('category_id', $category->id) as $recurringExpense)
                            <tr id="recurringExpense_{{ $recurringExpense->id }}" data-recurring-expense-id="{{ $recurringExpense->id }}">
                                <td style="border-left: 4px solid {{ $category->color }}" title="{{ $recurringExpense->name }} - {{ $category->name }}"><a href="{{ route('family.recurring-expenses.edit', [$family, $recurringExpense, 'return' => url()->current()]) }}">{{ $recurringExpense->name }}</a></td>
                                <td class="text-right">{{ Auth::user()->formatCurrency($recurringExpense->default_amount, true) }}</td>
                            </tr>
                        @endforeach
                    @endforeach

                    <tr>
                        <td><strong>{{ __('cash-flow-plans.total') }}</strong></td>
                        <td class="text-right"><strong>{{ Auth::user()->formatCurrency($recurringExpenses->sum('default_amount'), true) }}</strong></td>
                    </tr>
                </table>

            </div>

            <hr>

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
