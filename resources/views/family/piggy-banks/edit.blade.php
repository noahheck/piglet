@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('piggy-banks.piggy-banks') }} - {{ $piggyBank->name }} - {{ __('form.edit') }}
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
            route('family.piggy-banks.show', [$family, $piggyBank]) => $piggyBank->name,
        ],
        'location'   => __('form.edit'),
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.piggy-banks._form', [
                'action'      => route('family.piggy-banks.update', [$family, $piggyBank, 'return' => url()->previous()]),
                'method'      => 'PUT',
                'cancelRoute' => url()->previous(),
            ])

        </div>

    </div>

@endsection
