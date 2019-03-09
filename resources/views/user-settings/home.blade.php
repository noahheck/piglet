@extends('layouts.app')

@section('title')
- {{ __('user-settings.my_settings') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/user-settings.css') }}" />
@endpush

@push('meta')
    @meta('default-background-color', config('piglet.default-background-color'))
@endpush

@push('scripts')
    <script src="{{ mix("js/user-settings.js") }}"></script>
@endpush

@section('content')

    <div class="row">

        <div class="col-12 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">

            <div class="text-center">
                <img src="{{ $user->imagePath('thumbnail') }}" alt="User image" class="user-photo mb-2">
            </div>

            <div class="card">

                <div class="card-body">

                    <form method="POST" action="{{ route("user-settings.update") }}" class="has-bold-labels">

                        {{ csrf_field() }}

                        <fieldset>
                            <legend>{{ __('user-settings.user_details') }}</legend>

                            @formSuccess('user-settings-success')
                            @formSuccess('user-settings-password-success')
                            @formSuccess('user-settings-photo-success')

                            @formError

                            <div class="form-group">
                                <label for="user-settings_firstName">{{ __('user.firstName') }}</label>
                                <input type="text" class="form-control" id="user-settings_firstName" name='firstName' placeholder="{{ __('user.firstName') }}" value="{{ old('firstName', $user->firstName) }}">

                                @fieldError('firstName')
                            </div>
                            <div class="form-group">
                                <label for="user-settings_lastName">{{ __('user.lastName') }}</label>
                                <input type="text" class="form-control" id="user-settings_lastName" name='lastName' placeholder="{{ __('user.lastName') }}" value="{{ old('lastName', $user->lastName) }}">

                                @fieldError('lastName')
                            </div>
                            <div class="form-group">
                                <label for="user-settings_email">{{ __('user.email') }}</label>
                                @if(!$user->email_verified)
                                    <small>(You need to <a href="{{ route('user-settings.show-verify-email') }}">verify your email address</a>)</small>
                                @endif
                                <input type="email" class="form-control" id="user-settings_email" name='email' aria-describedby="emailHelp" placeholder="{{ __('user.email') }}" value="{{ old('email', $user->email) }}">

                                @fieldError('email')
                            </div>
                            <div class="form-group">
                                <label for="user-settings_timezone">{{ __('user.timezone') }}</label>
                                <select class="custom-select" id="user-settings_timezone" name='timezone' aria-describedby="timezoneHelp">
                                    @foreach(config('piglet.timezones') as $key => $value)
                                        <option value="{{ $key }}"{{ ($key === old('timezone', $user->timezone)) ? " selected='selected'" : "" }}>{{ $value }}</option>
                                    @endforeach
                                </select>

                                @fieldError('timezone')
                            </div>

                        </fieldset>

                        <hr>

                        <fieldset>

                            <legend>{{ __('user-settings.preferences') }}</legend>

                            <div class="form-group">
                                <label for="background_color">{{ __('user-settings.background_color') }}</label>
                                <button type="button" class="btn btn-link btn-sm" id="restoreBackgroundColorButton">{{ __('user-settings.restore-default') }}</button>
                                <input type="color" name="background_color" id="background_color" class="form-control" placeholder="{{ __('user-settings.background_color') }}" value="{{ old('background_color', $user->background_color) }}">
                                @fieldError('background_color')
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="user-settings_eventsEmail" name="events_email" {{ (old('events_email', $user->events_email)) ? "checked" : "" }}>
                                <label class="form-check-label" for="user-settings_eventsEmail">{{ __('user-settings.daily_event_email_pref') }}</label>
                            </div>

                        </fieldset>

                        <hr>

                        <div class="row">

                            <div class="col">
                                <button class="btn btn-primary btn-block" type="submit">
                                    {{ __('form.save') }}
                                </button>
                            </div>

                            <div class="col">
                                <a class="btn btn-secondary btn-block" href="{{ route("home") }}">{{ __('form.cancel') }}</a>
                            </div>

                        </div>


                    </form>

                </div>

            </div>

            <hr>

            <h4>{{ __('user-settings.other_options') }}:</h4>

            <div class="list-group">
                <a class="list-group-item list-group-item-action" href="{{ route('user-settings.photo') }}"><span class="fa fa-smile-o"></span> {{ __('user-settings.change_photo') }}</a>
                <a class="list-group-item list-group-item-action" href="{{ route('user-settings.password') }}"><span class="fa fa-shield"></span> {{ __('user-settings.change_password') }}</a>
                <a class="list-group-item list-group-item-action" href="{{ route('family.create') }}"><span class="fa fa-users"></span> {{ __('family.create-a-family') }}</a>
            </div>

        </div>

    </div>

@endsection
