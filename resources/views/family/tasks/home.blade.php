@extends('layouts.app')

@section('title')
 - {{ $family->name }} Tasks
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/home.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script src="{{ mix("js/home.js") }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [],
        'location'   => 'Tasks',
    ])

    <div class="row">
        <div class="col">
            <h2>
                Tasks
            </h2>
        </div>
    </div>

    <div class="row">



    </div>

@endsection
