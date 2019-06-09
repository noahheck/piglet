@extends('layouts.app')

@section('title')
 - Edit Family
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family/form.css') }}" />
@endpush

@push('scripts')
    <script src="{{ mix("js/family-details-form.js") }}"></script>
@endpush

@php

$menu = [
    ['type' => 'help', 'key' => 'family'],
];

if (!$family->allow_support_access) {
    $menu[] = ['type' => 'form', 'href' => route('family.enableSupportAccess', [$family]), 'id' => 'enableSupportAccess', 'icon' => 'fa fa-wrench', 'text' => __('family.enable-support-access')];
} else {
    $menu[] = ['type' => 'form', 'href' => route('family.disableSupportAccess', [$family]), 'id' => 'disableSupportAccess', 'icon' => 'fa fa-wrench', 'text' => __('family.disable-support-access')];
}

@endphp

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [],
        'location'   => __('family-settings.edit_family_details'),
        'menu' => $menu,
    ])

    <div class="row">

        <div class="col-12">

            @include('family/_form', [
                'legend'      => trans('family-settings.edit_family_details'),
                'action'      => route('family.update', $family),
                'method'      => 'PUT',
                'cancelRoute' => route('family.home', $family),
            ])

        </div>

    </div>

@endsection
