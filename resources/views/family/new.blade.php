@extends('layouts.app')

@section('title')
 - Create Family
@endsection

@section('stylesheets')
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/user-settings.css') }}" />--}}
@endsection

@section('scripts')
    {{--<script src="{{ asset("js/home.js") }}"></script>--}}
@endsection

@section('content')

    <div class="row">

        <div class="col-12">

            @include('family/_form')

        </div>

    </div>

@endsection
