@extends('layouts.app')

@section('title')
 - {{ $family->name }} - Members Home
@endsection

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />
@endsection

@section('scripts')

@endsection

@section('content')

    <div class="row">

        <div class="col-12">

            <div class="float-right">
                <a class="btn btn-sm btn-primary" href="{{ route('family.member.create', [$family]) }}">
                    <span class="fa fa-plus-circle"></span> Add new
                </a>
            </div>

            <a href="{{ route("family.home", [$family]) }}">Home</a>
            >
            Family Members

        </div>

    </div>

    <hr>

    <div class="row">
        <div class="col">
            <h2>Family Members</h2>
        </div>
    </div>

    <div class="row justify-content-center">

        @foreach($members as $member)
            <div class="col-6 col-md-4 col-lg-3">
                <a class="card shadow" href="{{ route('family.member.show', [$family, $member]) }}">
                    <img class="card-img-top card-img-bottoms" src="{{ $member->imagePath('full') }}" alt="{{ $member->firstName }} {{ $member->lastName }}">
                    <div class="card-footer text-muted">
                        <p class="ssscard-title">{{ $member->firstName }}</p>
                    </div>
                </a>
            </div>
        @endforeach

    </div>

@endsection
