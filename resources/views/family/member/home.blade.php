@extends('layouts.app')

@section('title')
 - {{ $family->name }} Home
@endsection

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />
@endsection

@section('scripts')
    {{--<script src="{{ asset("js/home.js") }}"></script>--}}
@endsection

@section('content')

    {{--@php
        dump($members);
    @endphp--}}

    <div class="row">

        <div class="col-12 col-md-4 text-center">

            <img class="rounded-circle img-fluid family-photo thumbnail" src="{{ $family->imagePath() }}" alt="Family photo">

        </div>

        <div class="col-12 col-md-8">

            <h2>{{ $family->name }}</h2>

            <p>{{ $family->details }}</p>

        </div>

    </div>

    <hr>

    <div class="row">

        {{--
            Loop through $members and output each one
         --}}

        <div class="col-4">
            <a class="card shadow" href="#">
                <div class="card-body">
                    <h5 class="card-title">Noah Heck</h5>
                </div>
            </a>
        </div>

        <div class="col-4">
            <a class="card shadow" href="#">
                <div class="card-body">
                    <h5 class="card-title">Noah Heck</h5>
                </div>
            </a>
        </div>

        <div class="col-4">
            <a class="card shadow" href="#">
                <div class="card-body">
                    <h5 class="card-title">Noah Heck</h5>
                </div>
            </a>
        </div>

    </div>

@endsection
