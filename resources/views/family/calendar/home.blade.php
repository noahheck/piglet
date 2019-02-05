@extends('layouts.app')

@section('title')
 - {{ $family->name }} Calendar
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/home.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script src="{{ mix("js/home.js") }}"></script>--}}
@endpush

@php
$lastMonth = $monthDetailProvider->previousMonth();
$nextMonth = $monthDetailProvider->nextMonth();
@endphp

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [],
        'location'   => __('calendar.calendar') . ' - ' . __('months.' . $month) . ' ' . $year,
        //'menu' => $menu,
    ])

    <div class="row">

        <div class="col-12 col-md-8">


            <div class="text-center">
                <h1>{{ __('months.' . $month) }} {{ $year }}</h1>
            </div>

            <div class="float-right">
                <a class="btn btn-outline-secondary" href="{{ route('family.calendar', [$family, $today->year, $today->month]) }}">
                    <span class="fa fa-calendar-check-o"></span> Today
                </a>
                <a class="btn btn-primary" href="#">
                    <span class="fa fa-calendar-plus-o"></span>
                </a>
            </div>

            <div>
                <a class="btn btn-secondary" href="{{ route('family.calendar', [$family, $lastMonth->year, $lastMonth->month]) }}">
                    <span class="fa fa-chevron-left"></span>
                </a>
                <a class="btn btn-secondary" href="{{ route('family.calendar', [$family, $nextMonth->year, $nextMonth->month]) }}">
                    <span class="fa fa-chevron-right"></span>
                </a>
            </div>

        </div>

        <div class="col-12 col-md-4">


        </div>

    </div>


@endsection
