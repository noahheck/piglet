@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('merchants.merchants') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/family.merchants.index.js') }}"></script>
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
        ],
        'location'   => __('merchants.merchants'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.merchants.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('merchants.add-new-merchant')],
            //['type' => 'help', 'key' => 'merchants'],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'merchants'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('merchants.merchants') }}</h2>

            <hr>

            @if (count($merchants) === 0)

                <p>{{ __('merchants.no-merchants-create') }}</p>
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.merchants.create', $family) }}"><span class="fa fa-plus-circle"></span> {{ __('merchants.add-new-merchant') }}</a>
                </p>

            @else

                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="fa fa-search"></span></div>
                    </div>
                    <input type="text" class="form-control dom-search" data-search-items="#merchantsTable tr.merchant" id="merchantSearch" placeholder="{{ __('merchants.search-merchants') }}">
                </div>

                <table class="table table-striped" id="merchantsTable">

                    <thead>
                        <tr>
                            <th>{{ __('merchants.name') }}</th>
                        </tr>
                    </thead>

                    @foreach ($merchants as $merchant)

                        <tr class="merchant" data-search-content="{{ $merchant->name }}">
                            <td>
                                <a href="{{ route('family.merchants.show', [$family, $merchant]) }}">
                                    {{ $merchant->name }}
                                </a>
                            </td>
                        </tr>

                    @endforeach

                </table>

                <hr>

            @endif

        </div>

    </div>

@endsection
