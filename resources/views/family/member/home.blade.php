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

        <div class="col-12 col-md-4 text-center">

            <img class="rounded-circle img-fluid family-photo thumbnail" src="{{ $family->imagePath('thumbnail') }}" alt="Family photo">

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

        @foreach($members as $member)
            <div class="col-12 col-sm-4 col-md-3">
                <a class="card shadow" href="{{ route("family.member.show", [$family, $member]) }}">
                    <img class="card-img-top card-img-bottoms" src="{{ $member->imagePath('full') }}" alt="{{ $member->firstName }} {{ $member->lastName }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $member->firstName }} {{ $member->lastName }}</h5>
                    </div>
                </a>
            </div>
        @endforeach

    </div>

@endsection
