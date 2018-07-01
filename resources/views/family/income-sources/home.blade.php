@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('income-sources.income-sources') }}
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
        'location'   => __('income-sources.income-sources'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.income-sources.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('income-sources.add-new-income-source')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3 col-xl-2">

            @include('family.shared.money-matters-nav', ['active' => 'income-sources'])

        </div>

        <div class="col-12 col-md-9 col-xl-10">

            <h2>{{ __('income-sources.income-sources') }}</h2>

            <hr>

            @if (count($incomeSources) === 0)

                <p>{{ __('income-sources.no-income-sources-create') }}</p>
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.income-sources.create', $family) }}"><span class="fa fa-plus-circle"></span> {{ __('income-sources.add-new-income-source') }}</a>
                </p>

            @else

                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="fa fa-search"></span></div>
                    </div>
                    <input type="text" class="form-control dom-search" data-search-items="#incomeSourcesTable tr.income-source" id="incomeSourceSearch" placeholder="{{ __('income-sources.search-income-sources') }}">
                </div>

                <table class="table table-striped" id="incomeSourcesTable">

                    <thead>
                        <tr>
                            <th>{{ __('income-sources.income-source') }}</th>
                        </tr>
                    </thead>

                    @foreach ($incomeSources as $source)

                        <tr class="income-source" data-search-content="{{ $source->name }}">
                            <td>
                                <a href="{{ route('family.income-sources.show', [$family, $source]) }}">
                                    {{ $source->name }}
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
