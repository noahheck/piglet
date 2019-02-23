@extends('layouts.app')

@section('title')
 - {{ $family->name }} - Calendar - {{ __('months.' . $month) }} {{ $year }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.calendar.calendar.css') }}" />
@endpush

@push('scripts')
    <script src="{{ mix("js/family.calendar.month.js") }}"></script>
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
                <a class="btn btn-outline-secondary" href="{{ route('family.calendar', [$family, $today->year, $today->month, $today->day]) }}" title="{{ __('calendar.today') }}">
                    <span class="fa fa-calendar-check-o"></span> {{ __('calendar.today') }}
                </a>
            </div>

            <div>
                <a class="btn btn-secondary" href="{{ route('family.calendar', [$family, $lastMonth->year, $lastMonth->month]) }}" title="{{ __('calendar.previous-month') }}">
                    <span class="fa fa-chevron-left"></span>
                    <span class="sr-only">{{ __('calendar.previous-month') }}</span>
                </a>
                <a class="btn btn-secondary" href="{{ route('family.calendar', [$family, $nextMonth->year, $nextMonth->month]) }}" title="{{ __('calendar.next-month') }}">
                    <span class="fa fa-chevron-right"></span>
                    <span class="sr-only">{{ __('calendar.next-month') }}</span>
                </a>
            </div>

            <table class="calendar" id="calendar">

                <thead>
                    <tr>
                        @for($x = 0; $x < 7; $x++)
                            <td>
                                <span class="d-none d-lg-inline">{{           __('days.' . $x)        }}</span>
                                <span class="d-none d-sm-inline d-lg-none">{{ __('days.' . $x . '_')  }}</span>
                                <span class="d-inline d-sm-none">{{           __('days.' . $x . '__') }}</span>
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

                            @php
                                $isToday = false;
                                if ($today->month == $month && $today->year == $year && $today->day == $x) {
                                    $isToday = true;
                                }
                            @endphp
                            <td class="{{ ($isToday) ? "is-today" : "" }}" data-controller="calendar--day-loader">
                                <a href="{{ route("family.calendar", [$family, $year, $month, $x]) }}" data-target="calendar--day-loader.link" data-action="calendar--day-loader#loadDayView">
                                    <div class="day-number">{{ $x }}</div>

                                    @if ($monthEntryProvider->hasEntryForDay($x))
                                        <span class="fa fa-circle"></span>
                                    @endif

                                </a>
                            </td>

                        @endfor

                        @for ($x = 1; $x <= $emptyCellsAtEnd; $x++)
                            <td class="empty-cell">&nbsp;</td>
                        @endfor

                    </tr>
                </tbody>

            </table>

        </div>

        <div class="col-12 col-md-4 pt-5" id="calendar_dayDetails">

            @include('family.calendar._day-detail', [])

        </div>

    </div>


@endsection
