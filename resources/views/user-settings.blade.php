@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user-settings.css') }}" />
@endsection

@section('scripts')
    {{--<script src="{{ asset("js/home.js") }}"></script>--}}
@endsection

@section('content')

    <div class="row">

        <div class="col-12 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">

            <div class="text-center">
                <span class="fa fa-user-circle" style="font-size: 128pt;"></span>
            </div>

            <hr>

            <form method="POST" action="{{ route("user-settings-update") }}" class="has-bold-labels">

                <div class="form-group">
                    <label for="user-settings_name">Name</label>
                    <input type="text" class="form-control" id="user-settings_name" placeholder="Name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="user-settings_email">Email address</label>
                    <input type="email" class="form-control" id="user-settings_email" aria-describedby="emailHelp" placeholder="Email address" value="{{ $user->email }}">
                </div>
                {{--<div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>--}}

            </form>

        </div>

    </div>

@endsection
