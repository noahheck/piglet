@extends('layouts.app')

@section('title')
 - {{ $family->name }} Home
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family/home.css') }}" />
@endpush

@push('scripts')
    {{--<script src="{{ mix("js/home.js") }}"></script>--}}
@endpush

@php

$menu = [];

if (Auth::user()->member->is_administrator) {
    $menu[] = [
        'type' => 'link',
        'href' => route('family.edit', [$family]),
        'icon' => 'fa fa-pencil-square-o',
        'text' => ucwords(__('form.edit_details')),
    ];
}

$menu[] = [
    'type' => 'help',
    'key'  => 'family',
];

@endphp

@section('content')

    @include('family.shared.breadcrumb', [
        'menu' => $menu,
    ])

    <div class="row">

        <div class="col-12 col-md-8 text-center">

            <h2>{{ $family->name }}</h2>

            {!! $family->photo(['rounded-circle', 'img-fluid', 'family-photo']) !!}

            @if (Auth::user()->member->is_administrator)
                <p><a href="{{ route('family.edit', $family) }}" class="btn btn-outline-primary">{{ ucwords(__('form.edit_details')) }}</a></p>
            @endif

        </div>

        <div class="col-12 col-md-4">

            <a class="card shadow component-link" href="{{ route('family.members.index', $family) }}">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="fa fa-users"></span>
                        {{ __('family-members.family_members') }}
                    </h5>
                    @foreach ($members as $member)
                        {!! $member->icon(['rounded-circle'])  !!}
                    @endforeach
                </div>
            </a>

            {{--<div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Goals <small class="text-muted">- Coming Soon!</small></h5>
                    Setting and tracking progress toward goals
                </div>
            </div>--}}

            <a class="card shadow component-link" href="{{ route('family.money-matters', $family) }}">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="fa fa-usd"></span>
                        {{ __('money-matters.money-matters') }}
                    </h5>
                    <p>
                        <span class="fa fa-pull-left fa-bar-chart fa-2x fa-border"></span>
                        {{ __('money-matters.money-matters-shortDesc') }}
                    </p>
                </div>
            </a>

            @if (App::isLocal())
                <a class="card shadow component-link" href="{{ route('family.taskLists.index', $family) }}">
                    <div class="card-body">
                        <h5 class="card-title">
                            <span class="fa fa-sstasks fa-check-square-o"></span>
                            Things to do
                        </h5>
                        <p>
                            <span class="fa fa-pull-left fa-list fa-2x fa-border"></span>
                            To do lists and things
                        </p>
                    </div>
                </a>
            @endif

            {{--<div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Schedule <small class="text-muted">- Coming Soon!</small></h5>
                    Schedule type things
                </div>
            </div>--}}

        </div>

    </div>

    @if ($currentCfp)

        <hr>

        <h3>{{ __('months.' . $currentCfp->month) }} {{ $currentCfp->year }}</h3>

        <div class="row justify-content-center">

            <div class="col-12 col-md-6">

                <a class="card shadow" href="{{ route('family.cash-flow-plans.show', [$family, $currentCfp]) }}">

                    <div class="card-body">

                        <canvas id="cfpActualBalanceChart" class="piglet-chart" data-chart-data='@json($currentCfp->actualBalanceChartData())'></canvas>

                    </div>

                </a>


            </div>

        </div>

    @endif

@endsection
