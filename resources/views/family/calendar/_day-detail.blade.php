@php

$nextDay     = $dayDetailProvider->nextDay();
$previousDay = $dayDetailProvider->previousDay();

$returnRoute = isset($returnRoute) ? $returnRoute : route('family.calendar', [$family, $year, $month, $day]);

@endphp

<div class="row">

    <div class="col-12">

        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('family.events.create', [$family, 'eventDate' => "{$month}/{$day}/{$year}", 'return' => $returnRoute]) }}">
                <span class="fa fa-calendar-plus-o"></span>
            </a>
        </div>

        <div>
            <span data-controller="calendar--day-loader">
                <a class="btn btn-secondary" href="{{ route('family.calendar', [$family, $previousDay->year, $previousDay->month, $previousDay->day]) }}" title="{{ __('calendar.previous-day') }}" data-target="calendar--day-loader.link" data-action="calendar--day-loader#loadDayView">
                    <span class="fa fa-chevron-left"></span>
                    <span class="sr-only">{{ __('calendar.previous-day') }}</span>
                </a>
            </span>
            <span data-controller="calendar--day-loader">
                <a class="btn btn-secondary" href="{{ route('family.calendar', [$family, $nextDay->year, $nextDay->month, $nextDay->day]) }}" title="{{ __('calendar.next-day') }}" data-target="calendar--day-loader.link" data-action="calendar--day-loader#loadDayView">
                    <span class="fa fa-chevron-right"></span>
                    <span class="sr-only">{{ __('calendar.next-day') }}</span>
                </a>
            </span>
        </div>

        <div class="card border-0 shadow mt-1 mb-5 day-card">
            <div class="card-body bg-red color-white">
                <h4 class="card-title text-center">
                    {{ __('months.' . $month) }} {{ $year }}
                </h4>
            </div>
            <div class="card-body text-center">
                <p class="display-1 mt-4">{{ $day }}</p>
                <p class="weekday-name">{{ __('days.' . $dayDetailProvider->dayOfWeek()) }}</p>
            </div>
        </div>

        <div class="entries">

            @foreach ($dayEntryProvider->events() as $event)
                @php
                    $iconClass = ($event->all_day) ? 'calendar' : 'clock-o';
                    $eventTime = ($event->all_day) ? '' : '<small>- ' . $event->time . '</small>';
                @endphp
                <a class="entry {{ ($event->all_day) ? 'all-day-entry' : '' }}" href="{{ route('family.events.edit', [$family, $event, 'return' => $returnRoute]) }}">
                    <h4>
                        <span class="fa fa-fw fa-{{ $iconClass }}"></span>
                        {{ $event->title }} {!! $eventTime !!}
                    </h4>

                    @if ($event->details)
                        <p>{{ $event->details }}</p>
                    @endif

                </a>
            @endforeach

        </div>


    </div>

</div>
