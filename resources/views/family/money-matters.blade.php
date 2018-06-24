@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('money-matters.money-matters') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [],
        'location'   => __('money-matters.money-matters'),
    ])

    <div class="row">

        <div class="col-12 col-md-3 col-xl-2">

            @include('family.shared.money-matters-nav', ['active' => 'home'])

        </div>

        <div class="col-12 col-md-9 col-xl-10">
            Charts and stuff
        </div>

    </div>

@endsection
