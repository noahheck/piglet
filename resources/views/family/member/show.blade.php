@extends('layouts.app')

@section('title')
 - {{ $family->name }} - {{ $member->firstName }} {{ $member->lastName }}
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
            <a href="{{ route("family.member.index", [$family]) }}"><span class="fa fa-chevron-left"></span> Back to family members</a>
            <h2>{{ $member->firstName }} {{ $member->lastName }}</h2>
        </div>

    </div>

    <div class="row">

        <div class="col-12 col-md-4 col-lg-3">

            <div class="card shadow">
                <img class="img-fluid card-img-top" src="{{ $member->imagePath('full') }}" alt="{{ $member->firstName }}">

                @if ($member->birthdate)
                    <div class="card-body">
                        {{ $member->age }} years - {{ ucfirst($member->gender) }}
                    </div>
                @endif

                <ul class="list-group list-group-flush">
                    <a href="{{ route('family.member.edit', [$family, $member]) }}"><li class="list-group-item"><span class="fa fa-pencil-square-o"></span> Edit Details</li></a>
                </ul>

            </div>

        </div>

        <div class="col-12 col-md-8 col-lg-9">



        </div>

    </div>

@endsection
