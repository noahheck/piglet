@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Merchants
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
<script type="text/javascript" src="{{ asset('js/family.merchants.index.js') }}"></script>
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family])   => 'Money Matters',
            route('family.merchants.index', [$family]) => 'Merchants',
        ],
        'location'   => $merchant->name,
        'menu' => [
            ['type' => 'link', 'href' => route('family.merchants.edit', [$family, $merchant]), 'icon' => 'fa fa-pencil-square-o', 'text' => 'Edit'],
        ]
    ])
            {{--['type' => 'link', 'href' => '#', 'icon' => 'fa fa-building', 'text' => 'Merchants'],
            ['type' => 'link', 'href' => '#', 'icon' => 'fa fa-cogs', 'text' => 'Settings'],--}}

    <div class="row">

        <div class="col-12 col-md-3 col-lg-2">

            @include('family.shared.money-matters-nav', ['active' => 'merchants'])

        </div>

        <div class="col-12 col-md-9 col-lg-10">

            <div class="row">

                <div class="col-12 col-md-7">

                    <h2>{{ $merchant->name }}</h2>

                    <hr>

                    @if ($merchant->url)
                        <p><a href="{{ $merchant->url }}" target="_blank">{{ $merchant->url }}</a></p>
                    @endif

                    <p>{{ $merchant->details }}</p>

                </div>

                <div class="col-12 col-md-5">

                    @if ($merchant->phone || $merchant->secondaryPhone || $merchant->address)

                        <div class="card shadow">

                            <h5 class="card-header">Contact</h5>

                            <div class="card-body">

                                <dl>
                                    @if ($merchant->phone || $merchant->secondaryPhone)
                                        <dt>Phone:</dt>
                                        <dd>{{ $merchant->phone }} {{ ($merchant->secondaryPhone) ? '|' : '' }} {{ $merchant->secondaryPhone }}</dd>
                                    @endif
                                    @if ($merchant->address)
                                        <dt>Address:</dt>
                                        <dd>{!! nl2br(e($merchant->address)) !!}</dd>
                                    @endif
                                </dl>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        <hr>




        </div>

    </div>

@endsection
