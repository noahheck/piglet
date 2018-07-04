@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('recurring-expenses.recurring-expenses') }} - {{ __('recurring-expenses.create-new') }}
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
            route('family.recurring-expenses.index', [$family]) => __('recurring-expenses.recurring-expenses'),
        ],
        'location'   => __('income-sources.create-new'),
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.recurring-expenses._form', [
                'action'      => route('family.recurring-expenses.store', [$family]),
                'method'      => false,
                'cancelRoute' => route('family.recurring-expenses.index', [$family]),
            ])

        </div>

    </div>

@endsection
