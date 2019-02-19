@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('expenses.expenses') }} - {{ $expense->title() }} - {{ __('form.edit') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
{{--    <script type="text/javascript" src="{{ mix('js/family.merchants.index.js') }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.cash-flow-plans.index', [$family]) => __('cash-flow-plans.cash-flow-plans'),
            route('family.cash-flow-plans.show', [$family, $cashFlowPlan]) => __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year,
            route('family.cash-flow-plans.expenses.index', [$family, $cashFlowPlan]) => __('expenses.expenses'),
            route('family.cash-flow-plans.expenses.show', [$family, $cashFlowPlan, $expense]) => $expense->title(),
        ],
        'location'   => __('form.edit'),
        'menu' => [
            ['type' => 'delete', 'href' => route('family.cash-flow-plans.expenses.destroy', [$family, $cashFlowPlan, $expense]) . '?' . app('request')->getQueryString(), 'text' => __('form.delete') . ' ' . __('expenses.expense')],
        ]
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.cash-flow-plans.expenses._form', [
                'action'      => route('family.cash-flow-plans.expenses.update', [$family, $cashFlowPlan, $expense]) . '?' . app('request')->getQueryString(),
                'method'      => 'PUT',
                'cancelRoute' => url()->previous(),
            ])

        </div>

    </div>

@endsection
