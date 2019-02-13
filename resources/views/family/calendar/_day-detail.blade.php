@php

$nextDay     = $dayDetailProvider->nextDay();
$previousDay = $dayDetailProvider->previousDay();

@endphp

<div class="row">

    <div class="col-12">

        <div class="sstext-right">
            <a class="btn btn-secondary" href="{{ route('family.calendar.day', [$family, $previousDay->year, $previousDay->month, $previousDay->day]) }}" title="{{ __('calendar.previous-day') }}">
                <span class="fa fa-chevron-left"></span>
                <span class="sr-only">{{ __('calendar.previous-day') }}</span>
            </a>
            <a class="btn btn-secondary" href="{{ route('family.calendar.day', [$family, $nextDay->year, $nextDay->month, $nextDay->day]) }}" title="{{ __('calendar.next-day') }}">
                <span class="fa fa-chevron-right"></span>
                <span class="sr-only">{{ __('calendar.next-day') }}</span>
            </a>
        </div>

        <div class="card border-0 shadow mt-1">
            <div class="card-body bg-red color-white">
                <h3 class="card-title text-center">
                    {{ __('months.' . $month) }} {{ $year }}
                </h3>
            </div>
            <div class="card-body text-center">
                <p class="display-1 mt-4">{{ $day }}</p>
                <p class="display-4">{{ __('days.' . $dayDetailProvider->dayOfWeek()) }}</p>
            </div>
        </div>


    </div>

</div>
