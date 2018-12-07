@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('income-sources.income-sources') }} - {{ $incomeSource->name }}
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
            route('family.money-matters', [$family])   => __('money-matters.money-matters'),
            route('family.income-sources.index', [$family]) => __('income-sources.income-sources'),
        ],
        'location'   => $incomeSource->name,
        'menu' => [
            ['type' => 'link', 'href' => route('family.income-sources.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('income-sources.add-new-income-source')],
            ['type' => 'link', 'href' => route('family.income-sources.edit', [$family, $incomeSource]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'income-sources'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ $incomeSource->name }}</h2>

            @if ($incomeSource->active)
                <p><span class="fa fa-check-square-o" title="Active"></span> {{ __('income-sources.active') }}
            @else
                <p class="text-muted"><span class="fa fa-square-o" title="Inactive"></span> {{ __('income-sources.inactive') }}
            @endif

                {{ ($incomeSource->default_amount) ? '- ' . App\formatCurrency($incomeSource->default_amount, true) : '' }}
            </p>

            <p>{!! nl2br(e($incomeSource->description)) !!}</p>

        </div>

        <hr>

    </div>

@endsection
