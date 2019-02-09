@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('events.events') }} - {{ $event->title }} - {{ __('form.edit') }}
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
            route('family.events.show', [$family, $event]) => $event->title,
        ],
        'location'   => __('form.edit'),
        'menu' => [
            ['type' => 'delete', 'href' => route('family.events.destroy', [$family, $event, 'return' => url()->previous()]), 'text' => __('form.delete') . ' ' . __('events.event')],
        ]
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.events._form', [
                'action'      => route('family.events.update', [$family, $event, 'return' => url()->previous()]),
                'method'      => 'PUT',
                'cancelRoute' => url()->previous(),
            ])

        </div>

    </div>

@endsection
