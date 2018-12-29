@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('piggy-banks.piggy-banks') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.piggy-banks.index.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/family.merchants.index.js') }}"></script>
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
        ],
        'location'   => __('piggy-banks.piggy-banks'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.piggy-banks.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('piggy-banks.add-new-piggy-bank')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'piggy-banks'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('piggy-banks.piggy-banks') }}</h2>

            <hr>

            @if (count($piggyBanks) === 0)

                <p>{{ __('piggy-banks.no-piggy-banks-create') }}</p>

                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.piggy-banks.create', $family) }}"><span class="fa fa-plus-circle"></span> {{ __('piggy-banks.add-new-piggy-bank') }}</a>
                </p>

            @else

                @if (count($piggyBanks->where('active', true)->where('completed', false)) > 0)

                    <h3>{{ __('piggy-banks.active-piggy-banks') }}</h3>

                    <div class="row">

                        @foreach ($piggyBanks->where('active', true)->where('completed', false) as $piggyBank)

                            <div class="col-12 col-md-6 piggy-bank">

                                @include('family.piggy-banks._card', ['family' => $family, 'piggyBank' => $piggyBank,])

                            </div>

                        @endforeach

                    </div>

                @endif



                    @if (count($piggyBanks->where('active', true)->where('completed', true)) > 0)

                        <h3>{{ __('piggy-banks.completed-piggy-banks') }}</h3>

                        <div class="row">

                            @foreach ($piggyBanks->where('active', true)->where('completed', true) as $piggyBank)

                                <div class="col-12 col-md-6 piggy-bank">

                                    @include('family.piggy-banks._card', ['family' => $family, 'piggyBank' => $piggyBank,])

                                </div>

                            @endforeach

                        </div>

                    @endif



                @if (count($piggyBanks->where('active', false)) > 0)

                    <h3>{{ __('piggy-banks.inactive-piggy-banks') }}</h3>

                    <div class="row">

                        @foreach ($piggyBanks->where('active', false) as $piggyBank)

                            <div class="col-12 col-md-6 piggy-bank">

                                @include('family.piggy-banks._card', ['family' => $family, 'piggyBank' => $piggyBank,])

                            </div>

                        @endforeach

                    </div>

                @endif

            @endif

        </div>

    </div>

@endsection
