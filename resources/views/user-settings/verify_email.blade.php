@extends('layouts.app')

@section('title')
- {{ __('user-settings.my_settings') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/user-settings.css') }}" />
@endpush

@push('scripts')
    {{--<script src="{{ mix("js/home.js") }}"></script>--}}
@endpush

@section('content')

    <div class="row">

        <div class="col-12 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">

            <div class="text-center">
                <img src="{{ $user->imagePath('thumbnail') }}" alt="User image" class="user-photo mb-2">
            </div>

            <div class="card">

                <div class="card-body">

                    <form method="POST" action="{{ route("user-settings.verify-email") }}" class="has-bold-labels">

                        @csrf

                        <fieldset>
                            <legend>Verify your email address</legend>

                            @formSuccess('new-user-email-verification')

                            @formError

                            <p>Before you can continue, we need to verify your email address. Currently, your email address is listed as:</p>

                            <p>
                                <strong>{{ $user->email }}</strong>
                                <small><br>Not your correct email address? <a href="{{ route('user-settings') }}">Change it here.</a></small>
                            </p>

                            <p>We have sent you an email with your verification pin number. Please enter it here:</p>

                            <div class="form-group">
                                <label for="verification">Verification PIN</label>
                                <input type="text" class="form-control" id="verification" name='verification' placeholder="Verification PIN" value="{{ old('verification', '') }}">

                                @fieldError('verification')
                            </div>

                            <div class="row">

                                <div class="col">
                                    <button class="btn btn-primary btn-block" type="submit">
                                        Verify
                                    </button>
                                </div>

                                <div class="col">
                                    <a class="btn btn-secondary btn-block" href="{{ route("user-settings") }}">{{ __('form.cancel') }}</a>
                                </div>

                            </div>

                        </fieldset>

                    </form>

                    <hr>

                    <form method="POST" action="{{ route('user-settings.new-email-pin') }}">

                        @csrf

                        <div class="row">

                            <div class="col">
                                <p>
                                    If you didn't receive an email with your PIN number, event here and we'll send you a new one:
                                </p>

                                @fieldError('newPin')

                                <button class="btn btn-block btn-warning" type="submit">
                                    Request new PIN
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
