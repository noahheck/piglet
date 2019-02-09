@extends('layouts.app')

@section('title')
 - {{ $family->name }} Calendar
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.calendar.calendar.css') }}" />
@endpush

@push('scripts')
    {{--<script src="{{ mix("js/home.js") }}"></script>--}}
@endpush

@php
$lastMonth = $monthDetailProvider->previousMonth();
$nextMonth = $monthDetailProvider->nextMonth();

$emptyCellsAtBeginning = $monthDetailProvider->emptyCellsAtBeginningOfMonth();
$emptyCellsAtEnd       = $monthDetailProvider->emptyCellsAtEndOfMonth();
$daysInMonth           = $monthDetailProvider->daysInMonth();


$weekPositionCounter = $emptyCellsAtBeginning;

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

            <table class="calendar" id="calendar">

                <thead>
                    <tr>
                        @for($x = 0; $x < 7; $x++)
                            <td>
                                <span class="d-none d-lg-inline">{{ __('days.' . $x) }}</span>
                                <span class="d-none d-sm-inline d-lg-none">{{ __('days.' . $x . '_') }}</span>
                                <span class="d-inline d-sm-none">{{ __('days.' . $x . '__') }}</span>
                            </td>
                        @endfor
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        @for ($x = 1; $x <= $emptyCellsAtBeginning; $x++)
                            <td class="empty-cell">&nbsp;</td>
                        @endfor

                        @for ($x = 1; $x <= $daysInMonth; $x++, $weekPositionCounter++)

                            @if ($weekPositionCounter == 7)
                                </tr><tr>
                                @php $weekPositionCounter = 0; @endphp
                            @endif

                            <td>
                                <div class="day-number">{{ $x }}</div>
                            </td>

                        @endfor

                        @for ($x = 1; $x <= $emptyCellsAtEnd; $x++)
                            <td class="empty-cell">&nbsp;</td>
                        @endfor

                    </tr>
                </tbody>

            </table>

        </div>

        <div class="col-12 col-md-4">


        </div>

    </div>


@endsection
