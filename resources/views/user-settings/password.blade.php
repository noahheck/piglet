@extends('layouts.app')

@section('title')
- {{ __('user-settings.my_settings') }} - {{ __('user-settings.password') }}
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

            <div class="card">

                <div class="card-body">

                    <a href="{{ route('user-settings') }}"><span class="fa fa-chevron-left"></span> {{ __('navigation.back') }}</a>

                    <form method="POST" action="{{ route("user-settings.password.update") }}" class="has-bold-labels">

                        {{ csrf_field() }}

                        <fieldset>
                            <legend>{{ __('user-settings.change_password') }}</legend>

                            @formError

                            <div class="form-group">
                                <label for="user-settings_password-current">{{ __('user-settings.current_password') }}</label>
                                <input type="password" class="form-control" id="user-settings_password-current" name='password_current' placeholder="{{ __('user-settings.current_password') }}" autofocus />

                                @fieldError('password_current')
                            </div>
                            <div class="form-group">
                                <label for="user-settings_password">{{ __('user-settings.new_password') }}</label>
                                <input type="password" class="form-control" id="user-settings_password" name='password' placeholder="{{ __('user-settings.new_password') }}" />

                                @fieldError('password')
                            </div>
                            <div class="form-group">
                                <label for="user-settings_password-confirmation">{{ __('user-settings.confirm_password') }}</label>
                                <input type="password" class="form-control" id="user-settings_password-confirmation" name='password_confirmation' placeholder="{{ __('user-settings.confirm_password') }}" />

                                @fieldError('password_confirmation')
                            </div>

                            <div class="row">

                                <div class="col">
                                    <button class="btn btn-primary btn-block" type="submit">
                                        {{ __('form.save') }}
                                    </button>
                                </div>

                                <div class="col">
                                    <a class="btn btn-secondary btn-block" href="{{ route("user-settings") }}">{{ __('form.cancel') }}</a>
                                </div>

                            </div>

                        </fieldset>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
