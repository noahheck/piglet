@extends('layouts.app')

@section('title')
 - {{ __('family-settings.archive_family') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/form.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script src="{{ mix("js/family-details-form.js") }}"></script>--}}
@endpush

@php

/*$menu = [
    ['type' => 'help', 'key' => 'family'],
];

if (!$family->allow_support_access) {
    $menu[] = ['type' => 'form', 'href' => route('family.enableSupportAccess', [$family]), 'id' => 'enableSupportAccess', 'icon' => 'fa fa-wrench', 'text' => __('family.enable-support-access')];
} else {
    $menu[] = ['type' => 'form', 'href' => route('family.disableSupportAccess', [$family]), 'id' => 'disableSupportAccess', 'icon' => 'fa fa-wrench', 'text' => __('family.disable-support-access')];
}*/

@endphp

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [],
        'location'   => 'Archive Family',
        'menu' => [],
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            <h2 class="text-center">{{ __('family-settings.are_sure_archive') }}</h2>

            <hr>

            <h3 class="text-center">{{ $family->name }}</h3>

            <div class="image-container">
                {!! $family->thumbnail(['rounded-circle', 'shadow']) !!}
            </div>

            {!! __('family-settings.archive_description') !!}

            <hr>

            <form action="{{ route('family.archive', [$family]) }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-warning">
                    {{ __('family-settings.archive_family') }}
                </button>

                <a class="btn btn-secondary" href="{{ route('family.home', [$family]) }}">
                    {{ __('form.cancel') }}
                </a>

            </form>

        </div>

    </div>

@endsection
