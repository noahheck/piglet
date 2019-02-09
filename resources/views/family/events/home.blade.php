@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('events.events') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ mix('js/family.merchants.index.js') }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'location'   => __('events.events'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.events.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('events.add-new-event')],
        ]
    ])

    <div class="row">

        <div class="col-12">

            <h2>{{ __('events.events') }}</h2>

            <hr>

            <div class="row justify-content-center mt-3">

                <div class="col-12 col-md-10 col-lg-8 col-xl-6">

                    @if (count($events) === 0)

                        <p>{{ __('events.no-events-create') }}</p>
                        <p class="text-center">
                            <a class="btn btn-primary" href="{{ route('family.events.create', $family) }}"><span class="fa fa-plus-circle"></span> {{ __('events.add-new-event') }}</a>
                        </p>

                    @else

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="fa fa-search"></span></div>
                            </div>
                            <input type="text" class="form-control dom-search" data-search-items=".event" id="eventSearch" placeholder="Search Events">
                        </div>

                        <ul class="list-group shadow mt-3" id="events">

                            @foreach ($events as $event)
                                <li class="event list-group-item">
                                    <a href="{{ route('family.events.edit', [$family, $event]) }}">{{ $event->title }}</a> - {{ $event->date }} {{ ($event->all_day) ? "All day" : $event->time }}
                                </li>
                            @endforeach

                        </ul>

                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection
