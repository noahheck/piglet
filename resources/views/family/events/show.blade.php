@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('events.events') }} - {{ $event->title }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.events.index', [$family]) => __('events.events'),
        ],
        'location'   => $event->title,
        'menu' => [
            ['type' => 'link', 'href' => route('family.events.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('events.add-new-event')],
            ['type' => 'link', 'href' => route('family.events.edit', [$family, $event]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            <h2>{{ $event->title }}</h2>

            <dl>
                <dt>{{ __('events.date') }}</dt>
                <dd>{{ $event->date }}</dd>

                <dt>{{ __('events.time') }}</dt>
                <dd>{{ ($event->all_day) ? 'All Day' : $event->time }}</dd>
            </dl>

            <p>
                {!! nl2br(e($event->details)) !!}
            </p>

        </div>

    </div>

@endsection
