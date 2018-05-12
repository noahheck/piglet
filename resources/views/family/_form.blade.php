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
                <img class="img-fluid rounded-circle" alt="Family photo" src="{{ $family->imagePath() }}">

                @if($family->image)
                    <button class="btn btn-secondary" type="button" id="showChangePhotoFormButton">
                        <span class="fa fa-photo"></span> Change Family Photo
                    </button>
                @endif

                <div class="custom-file {{ ($family->image) ? "d-none" : "" }}" id="familyPhotoInputContainer">
                    <input type="file" class="custom-file-input" id="familyPhoto" name="familyPhoto">
                    <label class="custom-file-label" for="familyPhoto">Family Photo</label>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-5">

                <div class="form-group">
                    <label for="family_name">Family Name</label>
                    <input type="text" class="form-control" id="family_name" name='name' placeholder="Family Name" value="{{ old('name', $family->name) }}">

                    @fieldError('name')
                </div>
                <div class="form-group">
                    <label for="family_details">Add some details</label>
                    <textarea name="details" id="family_details" class="form-control" placeholder="Details">{{ old('details', $family->details) }}</textarea>
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
