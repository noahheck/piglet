@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('merchants.merchants') }} - {{ __('merchants.create-new') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters',   [$family]) => __('money-matters.money-matters'),
            route('family.merchants.index', [$family]) => __('merchants.merchants'),
        ],
        'location'   => __('merchants.create-new'),
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.merchants._form', [
                'action'      => route('family.merchants.store', [$family]),
                'method'      => false,
                'cancelRoute' => route('family.merchants.index', [$family]),
            ])

        </div>

    </div>

@endsection
