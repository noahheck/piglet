@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Cash Flow Plans - Create - {{ __('months.' . $month) }} {{ $year }}
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
            route('family.cash-flow-plans.index', [$family]) => 'Cash Flow Plans',
        ],
        'location'   => 'Create - ' .__('months.' . $month) . ' ' . $year,
    ])
        {{--'menu' => [
            ['type' => 'link', 'href' => route('family.categories.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('categories.add-new-category')],
        ]--}}

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>Create Cash Flow Plan for {{ __('months.' . $month) }} {{ $year }}</h2>

            <hr>

            <p>
                The Cash Flow Plan will be created with the following entries:
                <br>
                <small class="text-muted">(Note: you'll be able to modify these entries later)</small>
            </p>

            <div class="section">
                <h3>Income Sources</h3>

                <table class="table table-sm">
                    <caption>{{ __('income-sources.income-sources') }}</caption>
                    <thead>
                    <tr class="font-weight-bold">
                        <td class="text-center">Name</td>
                        <td class="text-right">Projected</td>
                    </tr>
                    </thead>
                    @foreach ($incomeSources as $incomeSource)
                        <tr>
                            <td>{{ $incomeSource->name }}</td>
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
                <h3>Recurring Expenses</h3>

                <table class="table table-sm">
                    <caption>{{ __('recurring-expenses.recurring-expenses') }}</caption>
                    <thead>
                    <tr class="font-weight-bold">
                        <td class="text-center">Name</td>
                        <td class="text-right">Projected</td>
                    </tr>
                    </thead>
                    @foreach ($categories as $category)
                        @foreach ($recurringExpenses->where('category_id', $category->id) as $recurringExpense)
                            <tr id="recurringExpense_{{ $recurringExpense->id }}" data-recurring-expense-id="{{ $recurringExpense->id }}">
                                <td style="border-left: 4px solid {{ $category->color }}" title="{{ $recurringExpense->name }} - {{ $category->name }}">{{ $recurringExpense->name }}</td>
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

            <p>Are you sure you want to create this cash flow plan?</p>

            <form action="{{ route('family.cash-flow-plans.store-plan', [$family, $year, $month]) }}" method="POST">

                @csrf

                <button type="submit" class="btn btn-primary">
                    Create Plan
                </button>

                <a href="{{ route('family.cash-flow-plans.index', [$family]) }}" class="btn btn-secondary">Cancel</a>

            </form>

        </div>

    </div>

@endsection
