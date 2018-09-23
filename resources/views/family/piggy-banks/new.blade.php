@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('piggy-banks.piggy-banks') }} - {{ __('piggy-banks.create-new') }}
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
            route('family.piggy-banks.index', [$family]) => __('piggy-banks.piggy-banks'),
        ],
        'location'   => __('piggy-banks.create-new'),
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.piggy-banks._form', [
                'action'      => route('family.piggy-banks.store', [$family]),
                'method'      => false,
                'cancelRoute' => url()->previous(),
            ])

        </div>

    </div>

@endsection
