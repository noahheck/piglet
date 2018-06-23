@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Merchants
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters',   [$family]) => 'Money Matters',
            route('family.merchants.index', [$family]) => 'Merchants',
        ],
        'location'   => 'Create New',
    ])
        {{--'menu' => [
            ['type' => 'link', 'href' => route('family.merchants.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add New Merchant'],
        ]--}}

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
