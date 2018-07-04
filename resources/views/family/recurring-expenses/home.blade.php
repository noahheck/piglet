@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('recurring-expenses.recurring-expenses') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ asset('js/family.merchants.index.js') }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
        ],
        'location'   => __('recurring-expenses.recurring-expenses'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.recurring-expenses.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('recurring-expenses.add-new-recurring-expense')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'recurring-expenses'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('recurring-expenses.recurring-expenses') }}</h2>

            <hr>

            @if (count($recurringExpenses) === 0)

                <p>{{ __('recurring-expenses.no-recurring-expenses-create') }}</p>
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.recurring-expenses.create', $family) }}"><span class="fa fa-plus-circle"></span> {{ __('recurring-expenses.add-new-recurring-expense') }}</a>
                </p>

            @else


                <div class="row justify-content-center mt-3">

                    <div class="col-12 col-md-10 col-lg-8 col-xl-6">

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="fa fa-search"></span></div>
                            </div>
                            <input type="text" class="form-control dom-search" data-search-items="#activeRecurringExpenses .recurring-expense, #inactiveRecurringExpenses .recurring-expense" id="recurringExpenseSearch" placeholder="{{ __('recurring-expenses.search-recurring-expenses') }}">
                        </div>

                        @if ($recurringExpenses->where('active', true)->count() > 0)
                            <h4 class="mt-3">{{ __('recurring-expenses.active-recurring-expenses') }}</h4>
                        @endif

                        <ul class="list-group shadow active-income-sources" id="activeRecurringExpenses">

                            @foreach ($recurringExpenses->where('active', true) as $expense)

                                <li class="recurring-expense list-group-item">
                                    <a href="{{ route('family.recurring-expenses.show', [$family, $expense]) }}">
                                        {{ $expense->name }}
                                        {{ ($expense->default_amount) ? ' - ' . Auth::user()->formatCurrency($expense->default_amount, true) : '' }}
                                    </a>
                                </li>

                            @endforeach

                        </ul>

                        @if ($recurringExpenses->where('active', false)->count() > 0)
                            <hr class="mt-3">
                            <h4 class="mt-3">{{ __('recurring-expenses.inactive-recurring-expenses') }}</h4>
                        @endif

                        <ul class="list-group shadow inactive-recurring-expenses" id="inactiveRecurringExpenses">

                            @foreach ($recurringExpenses->where('active', false) as $expense)

                                <li class="recurring-expense list-group-item">
                                    <a href="{{ route('family.recurring-expenses.show', [$family, $expense]) }}">
                                        {{ $expense->name }}
                                        {{ ($expense->default_amount) ? ' - ' . Auth::user()->formatCurrency($expense->default_amount, true) : '' }}
                                    </a>
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            @endif

        </div>

    </div>

@endsection
