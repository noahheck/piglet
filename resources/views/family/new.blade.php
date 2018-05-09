@extends('layouts.app')

@section('title')
 - Create Family
@endsection

@section('stylesheets')
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/user-settings.css') }}" />--}}
@endsection

@section('scripts')
    {{--<script src="{{ asset("js/home.js") }}"></script>--}}
@endsection

@section('content')

    <div class="row">

        <div class="col-12 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">

            <div class="card">

                <div class="card-body">

                    <form method="POST" action="{{ route("family.store") }}" class="has-bold-labels">

                        {{ csrf_field() }}

                        <fieldset>
                            <legend>Family Details</legend>

                            {{--@formSuccess('user-settings-success')--}}
                            @formError

                            <div class="form-group">
                                <label for="family_name">Family Name</label>
                                <input type="text" class="form-control" id="family_name" name='name' placeholder="Family Name" value="{{ old('name') }}">

                                @fieldError('name')
                            </div>
                            <div class="form-group">
                                <label for="family_details">Add some details</label>
                                <textarea name="details" id="family_details" class="form-control" placeholder="Details">{{ old('details') }}</textarea>
                                @fieldError('details')
                            </div>
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

                        </fieldset>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
