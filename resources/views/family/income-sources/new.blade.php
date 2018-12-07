@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('income-sources.income-sources') }} - {{ __('income-sources.create-new') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters',   [$family]) => __('money-matters.money-matters'),
            route('family.income-sources.index', [$family]) => __('income-sources.income-sources'),
        ],
        'location'   => __('income-sources.create-new'),
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.income-sources._form', [
                'action'      => route('family.income-sources.store', [$family]),
                'method'      => false,
                'cancelRoute' => url()->previous(),
            ])

        </div>

    </div>

@endsection
