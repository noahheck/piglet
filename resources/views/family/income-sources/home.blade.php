@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Income Sources
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
        'location'   => 'Income Sources',
        'menu' => [
            ['type' => 'link', 'href' => route('family.income-sources.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add New Income Source'],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3 col-xl-2">

            @include('family.shared.money-matters-nav', ['active' => 'income-sources'])

        </div>

        <div class="col-12 col-md-9 col-xl-10">

            <h2>Income Sources</h2>

            <hr>

            @if (count($incomeSources) === 0)

                <p>You haven't added any income sources. You can go ahead and create your first one now:</p>
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.income-sources.create', $family) }}"><span class="fa fa-plus-circle"></span> Add New Income Source</a>
                </p>

            @else

                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="fa fa-search"></span></div>
                    </div>
                    <input type="text" class="form-control dom-search" data-search-items="#incomeSourcesTable tr.income-source" id="incomeSourceSearch" placeholder="Search Income Sources">
                </div>

                <table class="table table-striped" id="incomeSourcesTable">

                    <thead>
                        <tr>
                            <th>Source</th>
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
