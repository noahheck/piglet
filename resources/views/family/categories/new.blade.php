@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Categories - Create New
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters',    [$family]) => __('money-matters.money-matters'),
            route('family.categories.index', [$family]) => 'Categories',
        ],
        'location'   => 'Create New',
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.categories._form', [
                'action'      => route('family.categories.store', [$family]),
                'method'      => false,
                'cancelRoute' => route('family.categories.index', [$family]),
            ])

        </div>

    </div>

@endsection
