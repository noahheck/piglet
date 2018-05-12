<form method="POST" action="{{ route("family.store") }}" class="has-bold-labels" enctype="multipart/form-data">

    {{ csrf_field() }}

    <fieldset>
        <legend>Family Details</legend>

        @formError

        <div class="row">

            <div class="col-12 col-md-6">
                <img class="img-fluid rounded-circle" alt="Family photo" src="{{ $family->imagePath() }}">

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="familyPhoto" name="familyPhoto">
                    <label class="custom-file-label" for="familyPhoto">Choose file</label>
                </div>
            </div>

            <div class="col-12 col-md-6">

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

            </div>

        </div>

    </fieldset>

</form>
