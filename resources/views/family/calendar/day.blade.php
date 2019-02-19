@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Calendar - {{ __('months.' . $month) }} {{ $day }}, {{ $year }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.calendar.calendar.css') }}" />
@endpush

@push('scripts')
    {{--<script src="{{ mix("js/home.js") }}"></script>--}}
@endpush

@php
/*$lastMonth = $monthDetailProvider->previousMonth();
$nextMonth = $monthDetailProvider->nextMonth();

$emptyCellsAtBeginning = $monthDetailProvider->emptyCellsAtBeginningOfMonth();
$emptyCellsAtEnd       = $monthDetailProvider->emptyCellsAtEndOfMonth();
$daysInMonth           = $monthDetailProvider->daysInMonth();


$weekPositionCounter = $emptyCellsAtBeginning;*/

@endphp

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.calendar', [$family, $year, $month]) => __('calendar.calendar') . ' - ' . __('months.' . $month) . ' ' . $year,
        ],
        'location'   => __('months.' . $month) . ' ' . $day . ', ' . $year,
        //'menu' => $menu,
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-7 col-lg-5">

            @include('family.calendar._day-detail', [])

        </div>

    </div>


@endsection
