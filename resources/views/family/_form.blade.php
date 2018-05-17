@php

@endphp

<form method="POST" action="{{ $action }}" class="has-bold-labels" enctype="multipart/form-data">

    {{ csrf_field() }}

    @if ($method)
        @method($method)
    @endif

    <fieldset>
        <legend>{{ $legend }}</legend>

        @formError

        <div class="row">

            <div class="col-12 col-md-6 col-xl-7 text-center">
                <div>
                    <img class="img-fluid rounded-circle family-photo" alt="{{ __('family.family_photo') }}" src="{{ $family->imagePath() }}">
                </div>

                {{--<hr>--}}
                @if($family->image)
                    <button class="btn btn-secondary" type="button" id="showChangePhotoFormButton">
                        <span class="fa fa-photo"></span> {{ __('family-settings.change_family_photo') }}
                    </button>
                @endif

                <div class="custom-file {{ ($family->image) ? "d-none" : "" }}" id="familyPhotoInputContainer">
                    <input type="file" class="custom-file-input" id="familyPhoto" name="familyPhoto">
                    <label class="custom-file-label" for="familyPhoto">{{ __('family.family_photo') }}</label>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-5">

                <div class="form-group">
                    <label for="family_name">{{ __('family-settings.family_name') }}</label>
                    <input type="text" class="form-control" id="family_name" name='name' placeholder="{{ __('family-settings.family_name') }}" value="{{ old('name', $family->name) }}">

                    @fieldError('name')
                </div>
                <div class="form-group">
                    <label for="family_details">{{ __('family-settings.family_details') }}</label>
                    <textarea name="details" id="family_details" class="form-control" placeholder="{{ __('family-settings.family_details') }}">{{ old('details', $family->details) }}</textarea>
                    @fieldError('details')
                </div>
                <div class="row">

                    <div class="col">
                        <button class="btn btn-primary btn-block" type="submit">
                            {{ __('form.save') }}
                        </button>
                    </div>

                    <div class="col">
                        <a class="btn btn-secondary btn-block" href="{{ $cancelRoute }}">{{ __('form.cancel') }}</a>
                    </div>

                </div>

            </div>

        </div>

    </fieldset>

</form>
