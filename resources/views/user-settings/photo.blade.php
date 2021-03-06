@extends('layouts.app')

@section('title')
    - {{ __('user-settings.change_photo_title') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/user-settings.css') }}" />
@endpush

@push('scripts')
    {{--<script src="{{ mix("js/home.js") }}"></script>--}}
@endpush

@section('content')

    <div class="row">

        <div class="col-12 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3" data-controller="image-upload-preview">

            <div class="text-center user-upload-photo-container">
                {!! $user->thumbnail(['user-photo', 'mb-2', 'user-photo-upload'], ['target' => 'image-upload-preview.image']) !!}
            </div>

            <div class="card">

                <div class="card-body">

                    <form method="POST" action="{{ route("user-settings.photo.update") }}" class="has-bold-labels" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <fieldset>
                            <legend>{{ __('user-settings.update_profile_photo') }}</legend>

                            @formError

                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="profilePhoto" name="profilePhoto" data-action="image-upload-preview#preview" data-target="image-upload-preview.input">
                                    <label class="custom-file-label" for="profilePhoto">{{ __('form.choose_file') }}</label>
                                </div>
                                @fieldError('profilePhoto')
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
