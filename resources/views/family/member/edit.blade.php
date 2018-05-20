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

        <div class="col-12 col-md-4 col-lg-3">

            {{--<img class="rounded-circle img-fluid" src="" alt="{{ $member->firstName }}">--}}

            <hr>

            {{--@if ($member->birthdate)--}}
                {{--<p class="text-muted">{{ Auth::user()->formatDate($member->birthdate) }} ({{ $member->age }} years)</p>--}}
            {{--@endif--}}

            {{--<div class="list-group">--}}
                {{--<a class="list-group-item list-group-item-action" href="{{ route('family.member.edit', [$family, $member]) }}"><span class="fa fa-pencil-square-o"></span> Edit Details</a>--}}
            {{--</div>--}}

        </div>

        <div class="col-12 col-md-8 col-lg-9">

            <form method="POST" action="{{ route('family.member.update', [$family, $member]) }}" enctype="multipart/form-data" class="has-bold-labels">

                @csrf

                @method('PUT')



                <fieldset>
                    <legend>Details</legend>

                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" value="{{ old('firstName', $member->firstName) }}">
                    </div>

                    <div class="form-group">
                        <label for="middleName">Middle Name</label>
                        <input type="text" name="middleName" id="middleName" class="form-control" placeholder="Middle Name" value="{{ old('middleName', $member->middleName) }}">
                    </div>

                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" value="{{ old('lastName', $member->lastName) }}">
                    </div>

                    <div class="form-group">
                        <label for="suffix">Suffix</label>
                        <input type="text" name="suffix" id="suffix" class="form-control" placeholder="Suffix" value="{{ old('suffix', $member->suffix) }}">
                    </div>

                    <div class="form-group">
                        <label for="birthdate">Birthdate <small class="text-muted">mm/dd/yyyy</small></label>
                        <input type="text" name="birthdate" id="birthdate" class="form-control bs-datepicker" placeholder="Birthdate" value="{{ old('birthdate', Auth::user()->formatDate($member->birthdate)) }}">
                    </div>

                </fieldset>

                <button type="submit" class="btn btn-primary">Save</button>

                <a class="btn btn-secondary" href="{{ route('family.member.show', [$family, $member]) }}">Cancel</a>

            </form>

        </div>

    </div>

@endsection
