@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('merchants.merchants') }} - {{ $merchant->name }} - {{ __('form.edit') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters',   [$family]) => 'Money Matters',
            route('family.merchants.index', [$family]) => 'Merchants',
            route('family.merchants.show',  [$family, $merchant]) => $merchant->name,
        ],
        'location'   => __('form.edit'),
    ])
        {{--'menu' => [
            ['type' => 'link', 'href' => route('family.merchants.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add New Merchant'],
        ]--}}

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include ('family.merchants._form', [
                'action'      => route('family.merchants.update', [$family, $merchant]),
                'method'      => 'PUT',
                'cancelRoute' => route('family.merchants.show', [$family, $merchant]),
            ])

        </div>

    </div>

@endsection
