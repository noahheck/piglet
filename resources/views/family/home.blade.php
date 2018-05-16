@extends('layouts.app')

@section('title')
 - {{ $family->name }} Home
@endsection

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family/home.css') }}" />
@endsection

@section('scripts')
    {{--<script src="{{ asset("js/home.js") }}"></script>--}}
@endsection

@section('content')

    <div class="row">

        <div class="col-12 col-md-8 text-center">

            <h2>{{ $family->name }}</h2>

            <img class="rounded-circle img-fluid family-photo" src="{{ $family->imagePath() }}" alt="Family photo">

            @if ($familyUser->isAdministrator)
                <p><a href="{{ route('family.edit', $family) }}" class="btn btn-outline-primary">Edit Details</a></p>
            @endif

        </div>

        <div class="col-12 col-md-4">

            <a class="card shadow" href="{{ route('family.member.index', $family) }}">
                <div class="card-body">
                    <h5 class="card-title">Family Members</h5>
                    Stuff about the family members
                </div>
            </a>

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Goals <small class="text-muted">- Coming Soon!</small></h5>
                    Progress about the goals
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Budget <small class="text-muted">- Coming Soon!</small></h5>
                    Money Matters
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Things to do <small class="text-muted">- Coming Soon!</small></h5>
                    To do lists and things
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Schedule <small class="text-muted">- Coming Soon!</small></h5>
                    Schedule type things
                </div>
            </div>

        </div>

    </div>

@endsection
