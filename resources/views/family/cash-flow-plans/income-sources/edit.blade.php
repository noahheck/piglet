@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) . ' ' . $cashFlowPlan->year }} - {{ __('income-sources.income-sources') }} - {{ $incomeSource->name }} - {{ __('form.edit') }}
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
            route('family.cash-flow-plans.income-sources.index', [$family, $cashFlowPlan]) => __('income-sources.income-sources'),
            route('family.cash-flow-plans.income-sources.show', [$family, $cashFlowPlan, $incomeSource]) => $incomeSource->name,
        ],
        'location'   => __('form.edit'),
        'menu' => [
            ['type' => 'delete', 'href' => route('family.cash-flow-plans.income-sources.destroy', [$family, $cashFlowPlan, $incomeSource, 'return' => App\urlWithQueryString(url()->previous(), ['scroll' => 1])]), 'text' => __('form.delete') . ' ' . __('income-sources.income-source')],
            /*['type' => 'link', 'href' => route('family.cash-flow-plans.income-sources.create', [$family, $cashFlowPlan]), 'icon' => 'fa fa-plus-circle', 'text' => __('income-sources.add-new-income-source')],
            ['type' => 'link', 'href' => route('family.cash-flow-plans.income-sources.edit', [$family, $cashFlowPlan, $incomeSource]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],*/
        ]
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.cash-flow-plans.income-sources._form', [
                'action'      => route('family.cash-flow-plans.income-sources.update', [$family, $cashFlowPlan, $incomeSource, 'return' => App\urlWithQueryString(url()->previous(), ['scroll' => 1])]),
                'method'      => 'PUT',
                'cancelRoute' => App\urlWithQueryString(url()->previous(), ['scroll' => 1]),
            ])

        </div>

    </div>

@endsection
