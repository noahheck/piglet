@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('family-members.family_members') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />
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
            {{--['type' => 'link', 'href' => route('family.members.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add New'],--}}

    {{--<div class="row">

        <div class="col">
            <a class="card shadow" href="#">
                <div class="card-body">
                    <span class="fa fa-bar-chart"></span> Reports
                </div>
            </a>
        </div>

        <div class="col">
            <a class="card shadow" href="#">
                <div class="card-body">
                    <span class="fa fa-building"></span> Merchants
                </div>
            </a>
        </div>

        <div class="col">
            <a class="card shadow" href="#">
                <div class="card-body">
                    <span class="fa fa-cogs"></span> Settings
                </div>
            </a>
        </div>

    </div>

    <hr>--}}

@endsection
