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
