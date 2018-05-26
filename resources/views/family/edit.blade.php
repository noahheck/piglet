@extends('layouts.app')

@section('title')
 - Edit Family
@endsection

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family/form.css') }}" />
@endsection

@section('scripts')
    <script src="{{ asset("js/family-details-form.js") }}"></script>
@endsection

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [],
        'location'   => __('family-settings.edit_family_details'),
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
