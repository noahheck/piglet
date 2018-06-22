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
        'breadcrumb' => [],
        'location'   => 'Money Matters',
        'menu' => [
            ['type' => 'link', 'href' => '#', 'icon' => 'fa fa-bar-chart', 'text' => 'Reports'],
            ['type' => 'link', 'href' => '#', 'icon' => 'fa fa-building', 'text' => 'Merchants'],
            ['type' => 'link', 'href' => '#', 'icon' => 'fa fa-cogs', 'text' => 'Settings'],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3 col-lg-2">

            @include('family.shared.money-matters-nav', ['active' => 'merchants'])

        </div>

        <div class="col-12 col-md-9 col-lg-10">
            Merchants and shit
        </div>

    </div>

@endsection
