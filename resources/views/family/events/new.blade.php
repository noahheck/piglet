@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('events.events') }} - {{ __('events.create-new') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@php

    $actionRouteParams = [$family];

    if (app('request')->query('return')) {
        $actionRouteParams['return'] = app('request')->query('return');
    }

@endphp

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.events.index', [$family]) => __('events.events'),
        ],
        'location'   => __('events.create-new'),
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.events._form', [
                'action'      => route('family.events.store', $actionRouteParams),
                'method'      => false,
                'cancelRoute' => url()->previous(),
            ])

        </div>

    </div>

@endsection
