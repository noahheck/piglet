@extends('layouts.app')

@section('title')
- My Settings
@endsection

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
                <span class="fa fa-user-circle user-image-placeholder"></span>
            </div>

            <hr>

            <div class="card">

                <div class="card-body">

                    <form method="POST" action="{{ route("user-settings.update") }}" class="has-bold-labels">

                        {{ csrf_field() }}

                        <fieldset>
                            <legend>User Details</legend>

                            @formSuccess('user-settings-success')

                            @formError

                            {{--@if (Session::has('user-settings-success'))
                                <div class="alert alert-success">{{ Session::get('user-settings-success') }}</div>
                            @endif--}}

                            <div class="form-group">
                                <label for="user-settings_firstName">First Name</label>
                                <input type="text" class="form-control" id="user-settings_firstName" name='firstName' placeholder="First Name" value="{{ old('firstName', $user->firstName) }}">

                                @fieldError('firstName')
                            </div>
                            <div class="form-group">
                                <label for="user-settings_lastName">Last Name</label>
                                <input type="text" class="form-control" id="user-settings_lastName" name='lastName' placeholder="Last Name" value="{{ old('lastName', $user->lastName) }}">

                                @fieldError('lastName')
                            </div>
                            <div class="form-group">
                                <label for="user-settings_email">Email address</label>
                                <input type="email" class="form-control" id="user-settings_email" name='email' aria-describedby="emailHelp" placeholder="Email address" value="{{ old('email', $user->email) }}">

                                @fieldError('email')
                            </div>

                            <div class="row">

                                <div class="col">
                                    <button class="btn btn-primary btn-block" type="submit">
                                        Save
                                    </button>
                                </div>

                                <div class="col">
                                    <a class="btn btn-secondary btn-block" href="{{ route("home") }}">Cancel</a>
                                </div>

                            </div>

                        </fieldset>

                    </form>

                </div>

            </div>

            <hr>

            <h4>You might also want to:</h4>

            <div class="list-group">
                <a class="list-group-item list-group-item-action" href="#"><span class="fa fa-shield"></span> Change your password</a>
            </div>

            {{--<div class="accordion" id="user-settings_additionalOptions">

                <div class="card">

                    <div class="card-header" id="passwordFormHeader">
                        <h4>
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#passwordForm" aria-expanded="false" aria-controls="passwordForm">
                                Change your password
                            </button>
                        </h4>
                    </div>

                    <div id="passwordForm" class="collapse" aria-labelledby="passwordFormHeader" data-parent="#user-settings_additionalOptions">

                        <div class="card-body">

                            <form method="POST" action="{{ route("user-settings.update-password") }}" class="has-bold-labels">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="user-settings_password-current">Current Password</label>
                                    <input type="password" class="form-control" id="user-settings_password-current" name='password-current' placeholder="Current Password" />
                                </div>
                                <div class="form-group">
                                    <label for="user-settings_password">New Password</label>
                                    <input type="password" class="form-control" id="user-settings_password" name='password' placeholder="New Password" />
                                </div>
                                <div class="form-group">
                                    <label for="user-settings_password-confirmation">Confirm</label>
                                    <input type="password" class="form-control" id="user-settings_password-confirmation" name='password-confirmation' placeholder="Confirm Password" />
                                </div>

                                <button class="btn btn-warning btn-block" type="submit">
                                    Update Password
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>--}}

        </div>

    </div>

@endsection
