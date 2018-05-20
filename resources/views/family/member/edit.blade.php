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

    <form method="POST" action="{{ route('family.member.update', [$family, $member]) }}" enctype="multipart/form-data" class="has-bold-labels">

        <div class="row">

            <div class="col-12 col-md-4 col-lg-3">

                <div class="text-center">
                    <img class="rounded-circle img-fluid" src="{{ $member->imagePath('thumbnail') }}" alt="{{ $member->firstName }}">
                </div>

                @fieldError('memberPhoto')

                <div class="custom-file {{-- ($member->image) ? "d-none" : "" --}}" id="memberPhotoInputContainer">
                    <input type="file" class="custom-file-input" id="memberPhoto" name="memberPhoto">
                    <label class="custom-file-label" for="memberPhoto">Photo</label>
                </div>

                <hr>

            </div>

            <div class="col-12 col-md-8 col-lg-9">

                @csrf

                @method('PUT')

                <fieldset>
                    <legend>Details</legend>

                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" value="{{ old('firstName', $member->firstName) }}">
                        @fieldError('firstName')
                    </div>

                    <div class="form-group">
                        <label for="middleName">Middle Name</label>
                        <input type="text" name="middleName" id="middleName" class="form-control" placeholder="Middle Name" value="{{ old('middleName', $member->middleName) }}">
                        @fieldError('middleName')
                    </div>

                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" value="{{ old('lastName', $member->lastName) }}">
                        @fieldError('lastName')
                    </div>

                    <div class="form-group">
                        <label for="suffix">Suffix</label>
                        <input type="text" name="suffix" id="suffix" class="form-control" placeholder="Suffix" value="{{ old('suffix', $member->suffix) }}">
                        @fieldError('suffix')
                    </div>

                    <div class="form-group">
                        <label for="birthdate">Birthdate <small class="text-muted">mm/dd/yyyy</small></label>
                        <input type="text" name="birthdate" id="birthdate" class="form-control bs-datepicker" placeholder="Birthdate" value="{{ old('birthdate', Auth::user()->formatDate($member->birthdate)) }}">
                        @fieldError('birthdate')
                    </div>

                </fieldset>

                <button type="submit" class="btn btn-primary">Save</button>

                <a class="btn btn-secondary" href="{{ route('family.member.show', [$family, $member]) }}">Cancel</a>

            </div>

        </div>

    </form>

@endsection
