@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('piggy-banks.piggy-banks') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.piggy-banks.index.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.merchants.index.js') }}"></script>
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

                @if (count($piggyBanks->where('active', true)) > 0)

                    <h3>{{ __('piggy-banks.active-piggy-banks') }}</h3>

                    <div class="row">

                        @foreach ($piggyBanks->where('active', true) as $piggyBank)

                            <div class="col-12 col-md-6 piggy-bank">

                                <a href="{{ route('family.piggy-banks.show', [$family, $piggyBank]) }}">

                                    <div class="card shadow">

                                        <div class="card-body">

                                            <h5 class="card-title">{{ $piggyBank->name }}</h5>

                                            <p class="card-text text-dark">
                                                {{ App\formatDate($piggyBank->dueDate) }}
                                                @if ($piggyBank->monthly_contribution)
                                                    ({{ App\formatCurrency($piggyBank->monthly_contribution, true) }} / {{ __('months.month') }})
                                                @endif
                                            </p>

                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $piggyBank->percentCompleted }}%" aria-valuenow="{{ $piggyBank->balance }}" aria-valuemin="0" aria-valuemax="{{ App\formatCurrency($piggyBank->target_amount, false) }}"></div>
                                            </div>

                                            <hr>

                                            <p class="card-text text-dark">
                                                {{ App\formatCurrency($piggyBank->balance, true) }} / {{ App\formatCurrency($piggyBank->target_amount, true) }}
                                            </p>

                                        </div>

                                    </div>

                                </a>

                            </div>

                        @endforeach

                    </div>

                @endif

                @if (count($piggyBanks->where('active', false)) > 0)

                    <h3>{{ __('piggy-banks.inactive-piggy-banks') }}</h3>

                    <div class="row">

                        @foreach ($piggyBanks->where('active', false) as $piggyBank)

                            <div class="col-12 col-md-6 piggy-bank">

                                <a href="{{ route('family.piggy-banks.edit', [$family, $piggyBank]) }}">

                                    <div class="card shadow">

                                        <div class="card-body">

                                            <h5 class="card-title">{{ $piggyBank->name }}</h5>

                                            <p class="card-text">
                                                {{ App\formatDate($piggyBank->dueDate) }}
                                            </p>

                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $piggyBank->percentCompleted }}%" aria-valuenow="{{ $piggyBank->balance }}" aria-valuemin="0" aria-valuemax="{{ App\formatCurrency($piggyBank->target_amount, false) }}"></div>
                                            </div>

                                            <hr>

                                            <p class="card-text">
                                                {{ App\formatCurrency($piggyBank->balance, true) }} / {{ App\formatCurrency($piggyBank->target_amount, true) }}
                                            </p>

                                        </div>

                                    </div>

                                </a>

                            </div>

                        @endforeach

                    </div>

                @endif

            @endif

        </div>

    </div>

@endsection
