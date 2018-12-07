@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('income-sources.income-sources') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ mix('js/family.merchants.index.js') }}"></script>--}}
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

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'income-sources'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('income-sources.income-sources') }}</h2>

            <hr>

            @if (count($incomeSources) === 0)

                <p>{{ __('income-sources.no-income-sources-create') }}</p>
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.income-sources.create', $family) }}"><span class="fa fa-plus-circle"></span> {{ __('income-sources.add-new-income-source') }}</a>
                </p>

            @else


                <div class="row justify-content-center mt-3">

                    <div class="col-12 col-md-10 col-lg-8 col-xl-6">

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="fa fa-search"></span></div>
                            </div>
                            <input type="text" class="form-control dom-search" data-search-items="#activeIncomeSources .income-source, #inactiveIncomeSources .income-source" id="incomeSourceSearch" placeholder="{{ __('income-sources.search-income-sources') }}">
                        </div>

                        @if ($incomeSources->where('active', true)->count() > 0)
                            <h4 class="mt-3">{{ __('income-sources.active-income-sources') }}</h4>
                        @endif

                        <ul class="list-group shadow active-income-sources" id="activeIncomeSources">

                            @foreach ($incomeSources->where('active', true) as $source)

                                <li class="income-source list-group-item">
                                    <a href="{{ route('family.income-sources.edit', [$family, $source]) }}">
                                        {{ $source->name }}
                                        {{ ($source->default_amount) ? ' - ' . App\formatCurrency($source->default_amount, true) : '' }}
                                    </a>
                                </li>

                            @endforeach

                        </ul>

                        @if ($incomeSources->where('active', false)->count() > 0)
                            <hr class="mt-3">
                            <h4 class="mt-3">{{ __('income-sources.inactive-income-sources') }}</h4>
                        @endif

                        <ul class="list-group shadow inactive-income-sources" id="inactiveIncomeSources">

                            @foreach ($incomeSources->where('active', false) as $source)

                                <li class="income-source list-group-item">
                                    <a href="{{ route('family.income-sources.edit', [$family, $source]) }}">
                                        {{ $source->name }}
                                        {{ ($source->default_amount) ? ' - ' . App\formatCurrency($source->default_amount, true) : '' }}
                                    </a>
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

                {{--<table class="table table-striped" id="incomeSources">

                    <thead>
                        <tr>
                            <th>{{ __('income-sources.income-source') }}</th>
                            <th>Default Amount</th>
                        </tr>
                    </thead>

                    @foreach ($incomeSources as $source)

                        <tr class="income-source" data-search-content="{{ $source->name }} {{ App\formatCurrency($source->default_amount) }}">
                            <td>
                                <a href="{{ route('family.income-sources.show', [$family, $source]) }}">
                                    {{ $source->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('family.income-sources.show', [$family, $source]) }}">
                                    {{ ($source->default_amount) ? App\formatCurrency($source->default_amount, true) : '' }}
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
