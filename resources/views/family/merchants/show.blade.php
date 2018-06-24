@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('merchants.merchants') }} - {{ $merchant->name }}
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
            route('family.money-matters', [$family])   => __('money-matters.money-matters'),
            route('family.merchants.index', [$family]) => __('merchants.merchants'),
        ],
        'location'   => $merchant->name,
        'menu' => [
            ['type' => 'link', 'href' => route('family.merchants.edit', [$family, $merchant]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3 col-xl-2">

            @include('family.shared.money-matters-nav', ['active' => 'merchants'])

        </div>

        <div class="col-12 col-md-9 col-xl-10">

            <div class="row">

                <div class="col-12 col-md-7">

                    <h2>{{ $merchant->name }}</h2>

                    <p>{{ $merchant->details }}</p>

                </div>

                <div class="col-12 col-md-5">

                    @if ($merchant->url || $merchant->phone || $merchant->secondaryPhone || $merchant->address)

                        <div class="card shadow">

                            <h5 class="card-header">{{ __('merchants.contact') }}</h5>

                            <div class="card-body">

                                <dl>
                                    @if ($merchant->url)
                                        <dt>{{ __('merchants.website') }}:</dt>
                                        <dd><a href="{{ $merchant->url }}" target="_blank">{{ $merchant->url }}</a></dd>
                                    @endif
                                    @if ($merchant->phone || $merchant->secondaryPhone)
                                        <dt>{{ __('merchants.phone') }}:</dt>
                                        <dd>{{ $merchant->phone }} {{ ($merchant->secondaryPhone) ? '|' : '' }} {{ $merchant->secondaryPhone }}</dd>
                                    @endif
                                    @if ($merchant->address)
                                        <dt>{{ __('merchants.address') }}:</dt>
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
