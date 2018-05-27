@extends('layouts.app')

@section('title')
 - {{ $family->name }} Tasks
@endsection

@section('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/home.css') }}" />--}}
@endsection

@section('scripts')
    {{--<script src="{{ asset("js/home.js") }}"></script>--}}
@endsection

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
