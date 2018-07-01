@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Income Sources - {{ $incomeSource->name }}
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
            route('family.income-sources.index', [$family]) => 'Income Sources',
        ],
        'location'   => $incomeSource->name,
        'menu' => [
            ['type' => 'link', 'href' => route('family.income-sources.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add New Income source'],
            ['type' => 'link', 'href' => route('family.income-sources.edit', [$family, $incomeSource]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3 col-xl-2">

            @include('family.shared.money-matters-nav', ['active' => 'income-sources'])

        </div>

        <div class="col-12 col-md-9 col-xl-10">

            <h2>{{ $incomeSource->name }}</h2>

            @if ($incomeSource->active)
                <p><span class="fa fa-check-square-o" title="Active"></span> Active
            @else
                <p class="text-muted"><span class="fa fa-square-o" title="Inactive"></span> Inactive
            @endif

                {{ ($incomeSource->default_amount) ? '- $' . number_format($incomeSource->default_amount, 2) : '' }}
            </p>

            <p>{!! nl2br(e($incomeSource->details)) !!}</p>

        </div>

        <hr>

    </div>

@endsection
