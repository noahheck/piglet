@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('expense-groups.expense-groups') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ mix('js/family.merchants.index.js') }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
        ],
        'location'   => __('expense-groups.expense-groups'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.expense-groups.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('expense-groups.add-new-expense-group')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'expense-groups'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('expense-groups.expense-groups') }}</h2>

            <hr>

            @if (count($expenseGroups) === 0)

                <p>{{ __('expense-groups.no-expense-groups-create') }}</p>
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.expense-groups.create', $family) }}"><span class="fa fa-plus-circle"></span> {{ __('expense-groups.add-new-expense-group') }}</a>
                </p>

            @else

                <div class="row justify-content-center mt-3">

                    <div class="col-12 col-md-10 col-lg-8 col-xl-6">

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="fa fa-search"></span></div>
                            </div>
                            <input type="text" class="form-control dom-search" data-search-items=".expense-group" id="expenseGroupSearch" placeholder="{{ __('expense-groups.search-expense-groups') }}" autofocus>
                        </div>

                        @if ($expenseGroups->where('active', true)->count() > 0)
                            <h4 class="mt-3">{{ __('expense-groups.active-expense-groups') }}</h4>
                        @endif

                        <ul class="list-group shadow active-expense-groups" id="activeExpenseGroups">

                            @foreach ($expenseGroups->where('active', true) as $expenseGroup)

                                <li class="expense-group list-group-item">
                                    <a href="{{ route('family.expense-groups.edit', [$family, $expenseGroup]) }}">
                                        {{ $expenseGroup->name }}
                                        {{ ($expenseGroup->default_amount) ? ' - ' . App\formatCurrency($expenseGroup->default_amount, true) : '' }}
                                        @if ($expenseGroup->cash)
                                            <span class="float-right text-success fa fa-money mr-2 pt-1" title="{{ __('expense-groups.cash') }}"></span>
                                        @endif
                                    </a>
                                </li>

                            @endforeach

                        </ul>

                        @if ($expenseGroups->where('active', false)->count() > 0)
                            <hr class="mt-3">
                            <h4 class="mt-3">{{ __('expense-groups.inactive-expense-groups') }}</h4>
                        @endif

                        <ul class="list-group shadow inactive-expense-groups" id="inactiveExpenseGroups">

                            @foreach ($expenseGroups->where('active', false) as $expenseGroup)

                                <li class="expense-group list-group-item">
                                    <a href="{{ route('family.expense-groups.edit', [$family, $expenseGroup]) }}">
                                        {{ $expenseGroup->name }}
                                        {{ ($expenseGroup->default_amount) ? ' - ' . App\formatCurrency($expenseGroup->default_amount, true) : '' }}
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
