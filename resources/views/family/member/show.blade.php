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

    <div class="row">

        <div class="col-12">
            <h2>{{ $member->firstName }} {{ $member->lastName }}</h2>
        </div>

    </div>

    <div class="row">

        <div class="col-12 col-sm-4 col-lg-3">

            {{--<img class="rounded-circle img-fluid" src="" alt="{{ $member->firstName }}">--}}

            <hr>

            @if ($member->birthdate)
                <p class="text-muted">{{ Auth::user()->formatDate($member->birthdate) }} ({{ $member->age }} years)</p>
            @endif

            

        </div>

        <div class="col-12 col-sm-8 col-lg-9">



        </div>



        {{--<div class="col-12 col-md-4 text-center">

            <img class="rounded-circle img-fluid family-photo thumbnail" src="{{ $family->imagePath('thumbnail') }}" alt="Family photo">

        </div>

        <div class="col-12 col-md-8">

            <h2>{{ $family->name }}</h2>

            <p>{{ $family->details }}</p>

        </div>

    </div>

    <hr>

    <div class="row">

        <div class="col-12 col-sm-4">
            <a class="card shadow" href="{{ route("family.member.show", [$family, $member]) }}">
                --}}{{-- Family member's photo as a card photo header e.g. card-img-top --}}{{--
                <div class="card-body">
                    <h5 class="card-title">{{ $member->firstName }} {{ $member->lastName }}</h5>
                </div>
            </a>
        </div>

    </div>--}}

@endsection
