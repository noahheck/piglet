@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('recurring-expenses.recurring-expenses') }} - {{ $recurringExpense->name }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
{{--    <script type="text/javascript" src="{{ asset('js/family.merchants.index.js') }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family])   => __('money-matters.money-matters'),
            route('family.recurring-expenses.index', [$family]) => __('recurring-expenses.recurring-expenses'),
        ],
        'location'   => $recurringExpense->name,
        'menu' => [
            ['type' => 'link', 'href' => route('family.recurring-expenses.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('recurring-expenses.add-new-recurring-expense')],
            ['type' => 'link', 'href' => route('family.recurring-expenses.edit', [$family, $recurringExpense]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'recurring-expenses'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ $recurringExpense->name }}</h2>

            @if ($recurringExpense->active)
                <p><span class="fa fa-check-square-o" title="Active"></span> {{ __('recurring-expenses.active') }}
            @else
                <p class="text-muted"><span class="fa fa-square-o" title="Inactive"></span> {{ __('recurring-expenses.inactive') }}
            @endif

                {{ ($recurringExpense->default_amount) ? '- ' . Auth::user()->formatCurrency($recurringExpense->default_amount, true) : '' }}
                {{ ($recurringExpense->category) ? '- ' . $recurringExpense->category->name : '' }}
                {{ ($recurringExpense->sub_category) ? '- ' . $recurringExpense->sub_category : '' }}
            </p>

            <p>{!! nl2br(e($recurringExpense->description)) !!}</p>

        </div>

        <hr>

    </div>

@endsection
