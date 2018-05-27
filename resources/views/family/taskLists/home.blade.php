@extends('layouts.app')

@section('title')
 - {{ $family->name }} Task Lists
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
        'location'   => 'Task Lists',
    ])

    <div class="row">
        <div class="col">
            <h2>
                Task Lists
            </h2>
        </div>
    </div>

    <div class="row">



    </div>

@endsection
