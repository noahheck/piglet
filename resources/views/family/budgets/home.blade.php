@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Budgets
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family.categories.index.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ asset('js/family.categories.index.js') }}"></script>--}}
@endpush


@php

$months = [
    '01' => 'January',
    '02' => 'February',
    '03' => 'March',
    '04' => 'April',
    '05' => 'May',
    '06' => 'June',
    '07' => 'July',
    '08' => 'August',
    '09' => 'September',
    '10' => 'October',
    '11' => 'November',
    '12' => 'December',
];

@endphp


@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
        ],
        'location'   => 'Budgets',
    ])
        {{--'menu' => [
            ['type' => 'link', 'href' => route('family.categories.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('categories.add-new-category')],
        ]--}}

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'budget'])

        </div>

        <div class="col-12 col-md-9">

            <h2>Budgets</h2>

            <hr>

            <div class="accordion" id="budgetsAccordion">

                @foreach ($years as $year)

                    <div class="card" id="heading_{{ $year }}">
                        <div class="card-header">
                            <h5>
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse_{{ $year }}">
                                    {{ $year }}
                                </button>
                            </h5>
                        </div>

                        <div id="collapse_{{ $year }}" class="collapse" data-parent="#budgetsAccordion">

                            <ul class="list-group list-group-flush">

                                @foreach($months as $key => $month)

                                    @php
                                        $budget = $budgets->where('year', $year)->firstWhere('month', $key);
                                    @endphp

                                    <li class="list-group-item">

                                        @if ($budget)

                                            <a href="{{ route('family.budgets.show', [$family, $budget]) }}">{{ $key }}/{{ $budget->year }}</a>

                                        @else
                                            No budget found - Create one now
                                        @endif
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

@endsection
