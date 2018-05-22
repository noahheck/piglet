<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12 col-md-4 col-lg-5">

            <div class="text-center member-photo-image-container">
                <div class="card shadow">
                    <img class="card-img-top" src="{{ $member->imagePath('full') }}" alt="{{ $member->firstName }}">
                </div>
            </div>

            @fieldError('memberPhoto')

            @if($member->image)
                <div class="text-center">
                    <button class="btn btn-secondary" type="button" id="showChangePhotoFormButton">
                        <span class="fa fa-photo"></span> Change photo
                    </button>
                </div>
            @endif

            <div class="custom-file {{ ($member->image) ? "d-none" : "" }}" id="memberPhotoInputContainer">
                <input type="file" class="custom-file-input" id="memberPhoto" name="memberPhoto">
                <label class="custom-file-label" for="memberPhoto">Photo</label>
            </div>

            <hr>

        </div>

        <div class="col-12 col-md-8 col-lg-7">


            <fieldset>
                <legend>Details</legend>

                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" value="{{ old('firstName', $member->firstName) }}">
                    @fieldError('firstName')
                </div>

                <div class="form-group">
                    <label for="middleName">Middle Name</label>
                    <input type="text" name="middleName" id="middleName" class="form-control" placeholder="Middle Name" value="{{ old('middleName', $member->middleName) }}">
                    @fieldError('middleName')
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" value="{{ old('lastName', $member->lastName) }}">
                    @fieldError('lastName')
                </div>

                <div class="form-group">
                    <label for="suffix">Suffix</label>
                    <input type="text" name="suffix" id="suffix" class="form-control" placeholder="Suffix" value="{{ old('suffix', $member->suffix) }}">
                    @fieldError('suffix')
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="custom-select" name="gender" id="gender">
                        <option value="">--</option>
                        <option value="male" {{ (old('gender', $member->gender) === 'male') ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ (old('gender', $member->gender) === 'female') ? 'selected' : '' }}>Female</option>
                    </select>
                    @fieldError('gender')
                </div>

                <div class="form-group">
                    <label for="birthdate">Birthdate <small class="text-muted">mm/dd/yyyy</small></label>
                    <input type="text" name="birthdate" id="birthdate" class="form-control bs-datepicker" placeholder="Birthdate" value="{{ old('birthdate', Auth::user()->formatDate($member->birthdate)) }}">
                    @fieldError('birthdate')
                </div>

            </fieldset>

            <button type="submit" class="btn btn-primary">Save</button>

            <a class="btn btn-secondary" href="{{ $cancelRoute }}">Cancel</a>

        </div>

    </div>

</form>
