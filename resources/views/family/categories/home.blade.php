@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Categories
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ asset('js/family.merchants.index.js') }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
        ],
        'location'   => 'Categories',
        'menu' => [
            ['type' => 'link', 'href' => route('family.categories.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add New Category'],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3 col-xl-2">

            @include('family.shared.money-matters-nav', ['active' => 'categories'])

        </div>

        <div class="col-12 col-md-9 col-xl-10">

            <h2>Categories</h2>

            <hr>

            @if (count($categories) === 0)
                <p>You haven't added any categories yet. Go ahead and create your first one now:</p>
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.categories.create', $family) }}"><span class="fa fa-plus-circle"></span> Add New Category</a>
                </p>
            @else

                {{--<h2>{{ __('merchants.merchants') }}</h2>

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

                <hr>--}}

            @endif

        </div>

    </div>

@endsection
