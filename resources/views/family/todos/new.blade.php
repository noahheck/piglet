@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('todos.todos') }} - {{ __('todos.create-new') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

{{--@php

    /*$actionRouteParams = [$family];

    if (app('request')->query('return')) {
        $actionRouteParams['return'] = app('request')->query('return');
    }*/

@endphp--}}

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.todos.index', [$family]) => __('todos.todos'),
        ],
        'location'   => __('todos.create-new'),
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.todos._form', [
                'action'      => route('family.todos.store', [$family]),
                'method'      => false,
                'cancelRoute' => old('return', url()->previous()),
            ])

        </div>

    </div>

@endsection
