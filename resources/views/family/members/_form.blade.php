<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12 col-md-4 col-lg-5">

            <div class="text-center member-photo-image-container">
                <div class="card shadow">
                    {!! $member->photo(['card-img-top']) !!}
                </div>
            </div>

            @fieldError('memberPhoto')

            @if($member->image)
                <div class="text-center">
                    <button class="btn btn-secondary" type="button" id="showChangePhotoFormButton">
                        <span class="fa fa-photo"></span> {{ __('family-members.change_photo') }}
                    </button>
                </div>
            @endif

            <div class="custom-file {{ ($member->image) ? "d-none" : "" }}" id="memberPhotoInputContainer">
                <input type="file" class="custom-file-input" id="memberPhoto" name="memberPhoto">
                <label class="custom-file-label" for="memberPhoto">{{ __('form.photo') }}</label>
            </div>

            <hr>

        </div>

        <div class="col-12 col-md-8 col-lg-7">

            <ul class="nav nav-tabs" id="memberTabs" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="loginTab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false">Login</a>
                </li>
            </ul>

            <div class="tab-content" id="memberTabsContent">

                <div class="tab-pane show active" id="details" role="tabpanel" aria-labelledby="detailsTab">

                    <fieldset>
                        <legend>{{ $legend }}</legend>

                        <div class="form-group">
                            <label for="firstName">{{ __('family-members.firstName') }}</label>
                            <input type="text" name="firstName" id="firstName" class="form-control" placeholder="{{ __('family-members.firstName') }}" value="{{ old('firstName', $member->firstName) }}">
                            @fieldError('firstName')
                        </div>

                        <div class="form-group">
                            <label for="middleName">{{ __('family-members.middleName') }}</label>
                            <input type="text" name="middleName" id="middleName" class="form-control" placeholder="{{ __('family-members.middleName') }}" value="{{ old('middleName', $member->middleName) }}">
                            @fieldError('middleName')
                        </div>

                        <div class="form-group">
                            <label for="lastName">{{ __('family-members.lastName') }}</label>
                            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="{{ __('family-members.lastName') }}" value="{{ old('lastName', $member->lastName) }}">
                            @fieldError('lastName')
                        </div>

                        <div class="form-group">
                            <label for="suffix">{{ __('family-members.suffix') }}</label>
                            <input type="text" name="suffix" id="suffix" class="form-control" placeholder="{{ __('family-members.suffix') }}" value="{{ old('suffix', $member->suffix) }}">
                            @fieldError('suffix')
                        </div>

                        <div class="form-group">
                            <label for="gender">{{ __('family-members.gender') }}</label>
                            <select class="custom-select" name="gender" id="gender">
                                <option value="">--</option>
                                <option value="male" {{ (old('gender', $member->gender) === 'male') ? 'selected' : '' }}>{{ __('family-members.male') }}</option>
                                <option value="female" {{ (old('gender', $member->gender) === 'female') ? 'selected' : '' }}>{{ __('family-members.female') }}</option>
                            </select>
                            @fieldError('gender')
                        </div>

                        <div class="form-group">
                            <label for="birthdate">{{ __('family-members.birthdate') }} <small class="text-muted">mm/dd/yyyy</small></label>
                            <input type="text" name="birthdate" id="birthdate" class="form-control dateField" placeholder="{{ __('family-members.birthdate') }}" value="{{ old('birthdate', Auth::user()->formatDate($member->birthdate)) }}">
                            @fieldError('birthdate')
                        </div>

                        <div class="form-group">
                            <label for="color">{{ __('family-members.color') }}</label>
                            <a href="#" class="dismissable-popover" data-toggle="popover" data-content="{{ __('family-members.color_desc') }}"><span class="fa fa-question-circle"></span></a>
                            <input type="color" name="color" id="color" class="form-control" placeholder="{{ __('family-members.color') }}" value="{{ old('color', $member->color) }}">
                            @fieldError('color')
                        </div>

                    </fieldset>

                </div>

                <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="loginTab">

                    <fieldset>

                        <legend>Login Information</legend>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="allow_login" name="allow_login" {{ ($member->allow_login) ? "checked" : "" }}>
                            <label class="form-check-label" for="allow_login">
                                Allow this person to log in
                            </label>
                        </div>

                        <div class="collapse" id="loginDetails">

                            <div class="form-group">
                                <label for="login_email">Login Email</label>
                                <input type="text" name="login_email" id="login_email" class="form-control" placeholder="Login Email" value="{{ old('login_email', $member->login_email) }}">
                                @fieldError('login_email')
                            </div>

                        </div>

                        <hr>

                    </fieldset>

                </div>


            </div>

            <button type="submit" class="btn btn-primary">
                {{ __('form.save') }}
            </button>

            <a class="btn btn-secondary" href="{{ $cancelRoute }}">
                {{ __('form.cancel') }}
            </a>

        </div>

    </div>

</form>
