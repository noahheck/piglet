@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Cash Flow Plans - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - Income Sources - {{ $incomeSource->name }} ({{ $incomeSource->typeDescription() }}) - {{ __('form.edit') }}
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
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.cash-flow-plans.index', [$family]) => 'Cash Flow Plans',
            route('family.cash-flow-plans.show', [$family, $cashFlowPlan]) => __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year,
            route('family.cash-flow-plans.income-sources.index', [$family, $cashFlowPlan]) => 'Income Sources',
            route('family.cash-flow-plans.income-sources.show', [$family, $cashFlowPlan, $incomeSource]) => $incomeSource->name . ' (' . $incomeSource->typeDescription() . ')',
        ],
        'location'   => __('form.edit'),
        /*'menu' => [
            ['type' => 'link', 'href' => route('family.cash-flow-plans.income-sources.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('income-sources.add-new-income-source')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.income-sources.edit', [$family, $cashFlowPlan, $incomeSource]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]*/
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.cash-flow-plans.income-sources._form', [
                'action'      => route('family.cash-flow-plans.income-sources.update', [$family, $cashFlowPlan, $incomeSource]),
                'method'      => 'PUT',
                'cancelRoute' => route('family.cash-flow-plans.income-sources.show', [$family, $cashFlowPlan, $incomeSource]),
            ])

        </div>

    </div>

    {{--<div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'cash-flow-plans'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ $incomeSource->name }}</h2>

            <p>
                {{ $incomeSource->typeDescription() . ' - ' . Auth::user()->formatCurrency($incomeSource->amount, true) }}
            </p>

            <p>{!! nl2br(e($incomeSource->detail)) !!}</p>

        </div>

        <hr>

    </div>--}}

@endsection
