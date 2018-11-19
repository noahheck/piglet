@extends('layouts.app')

@section('title')
 - Create Family
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family/form.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset("js/family-details-form.js") }}"></script>
@endpush

@section('content')

    <div class="row">

        <div class="col-12">

            @include('family/_form', [
                'legend' => trans('family-settings.new_family_details'),
                'action' => route('family.store'),
                'method' => false,
                'cancelRoute' => url()->previous(),
            ])

        </div>

    </div>

@endsection
