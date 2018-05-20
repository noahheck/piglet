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
            <a href="{{ route("family.member.index", [$family]) }}"><span class="fa fa-chevron-left"></span> Back</a>
            <h2>{{ $member->firstName }} {{ $member->lastName }}</h2>
        </div>

    </div>

    <div class="row">

        <div class="col-12 col-md-4 col-lg-3">

            <div class="text-center">
                <img class="rounded-circle img-fluid" src="{{ $member->imagePath('thumbnail') }}" alt="{{ $member->firstName }}">
            </div>

            <hr>

            @if ($member->birthdate)
                <p class="text-muted">{{ Auth::user()->formatDate($member->birthdate) }} ({{ $member->age }} years)</p>
            @endif

            <div class="list-group">
                <a class="list-group-item list-group-item-action" href="{{ route('family.member.edit', [$family, $member]) }}"><span class="fa fa-pencil-square-o"></span> Edit Details</a>
            </div>

        </div>

        <div class="col-12 col-md-8 col-lg-9">



        </div>

    </div>

@endsection
