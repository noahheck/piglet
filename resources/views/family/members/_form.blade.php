<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    <div class="row">

        <div class="col-12 col-md-4 col-lg-5" data-controller="image-upload-preview">

            <div class="text-center member-photo-image-container">
                <div class="card shadow">
                    {!! $member->photo(['card-img-top'], ['target' => 'image-upload-preview.image']) !!}
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
                <input type="file" class="custom-file-input" id="memberPhoto" name="memberPhoto" data-action="image-upload-preview#preview" data-target="image-upload-preview.input">
                <label class="custom-file-label" for="memberPhoto">{{ __('form.photo') }}</label>
            </div>

            <hr>

        </div>

        <div class="col-12 col-md-8 col-lg-7">

            <ul class="nav nav-tabs" id="memberTabs" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="infoTab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">{{ __('family-members.info_tab') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">{{ __('family-members.details_tab') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="loginTab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false">{{ __('family-members.login_tab') }}</a>
                </li>
            </ul>

            <div class="tab-content" id="memberTabsContent">

                <div class="tab-pane show active fade" id="info" role="tabpanel" aria-labelledby="infoTab">

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
                            <input type="text" name="birthdate" id="birthdate" class="form-control dateField datepicker" placeholder="{{ __('family-members.birthdate') }}" value="{{ old('birthdate', App\formatDate($member->birthdate)) }}">
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

                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="detailsTab">

                    <fieldset>

                        <legend>{{ __('family-members.details') }}</legend>

                        <div class="form-group">
                            <label for="race">{{ __('family-members.race') }}</label>
                            <select class="custom-select" id="race" name="race" aria-describedby="">
                                <option value="">--</option>
                                @foreach(config('piglet.races') as $value)
                                    <option value="{{ $value }}" {{ ($value === old('race', $member->race)) ? "selected='selected'" : "" }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @fieldError('race')
                        </div>

                        <div class="form-group">
                            <label for="height">{{ __('family-members.height') }}</label>
                            <input type="text" name="height" id="height" class="form-control" placeholder="{{ __('family-members.height_placeholder') }}" value="{{ old('height', $member->height) }}">
                            @fieldError('height')
                        </div>

                        <div class="form-group">
                            <label for="weight">{{ __('family-members.weight') }}</label>
                            <input type="text" name="weight" id="weight" class="form-control" placeholder="{{ __('family-members.weight_placeholder') }}" value="{{ old('weight', $member->weight) }}">
                            @fieldError('weight')
                        </div>

                        <div class="form-group">
                            <label for="eye_color">{{ __('family-members.eye_color') }}</label>
                            <input type="text" name="eye_color" id="eye_color" class="form-control" placeholder="{{ __('family-members.eye_color_placeholder') }}" value="{{ old('eye_color', $member->eye_color) }}">
                            @fieldError('eye_color')
                        </div>

                        <div class="form-group">
                            <label for="hair_color">{{ __('family-members.hair_color') }}</label>
                            <input type="text" name="hair_color" id="hair_color" class="form-control" placeholder="{{ __('family-members.hair_color_placeholder') }}" value="{{ old('hair_color', $member->hair_color) }}">
                            @fieldError('hair_color')
                        </div>

                        <hr>

                        <p>{{ __('family-members.does_member_wear') }}</p>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="glasses" id="glasses" {{ (old('glasses', $member->glasses)) ? ' checked' : '' }}>
                            <label for="glasses">{{ __('family-members.glasses') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="contacts" id="contacts" {{ (old('contacts', $member->contacts)) ? ' checked' : '' }}>
                            <label for="contacts">{{ __('family-members.contacts') }}</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="braces" id="braces" {{ (old('braces', $member->braces)) ? ' checked' : '' }}>
                            <label for="braces">{{ __('family-members.braces') }}</label>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="identifying_features">{{ __('family-members.identifying_features') }}</label> <small>-  {{ __('family-members.identifying_features_examples') }}</small>
                            <textarea name="identifying_features" id="identifying_features" class="form-control" placeholder="{{ __('family-members.identifying_features_placeholder') }}">{{ old('identifying_features', $member->identifying_features) }}</textarea>
                            @fieldError('details')
                        </div>

                    </fieldset>

                </div>

                <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="loginTab">

                    <fieldset>

                        <legend>{{ __('family-members.login_information') }}</legend>

                        @php
                            $dummyAllowLogin = "";
                            $disabled        = "";
                            $helpIcon        = "";
                            if ((int) Auth::user()->id === (int) $member->user_id) {
                                $dummyAllowLogin = "<input type='hidden' name='allow_login' value='1'>";
                                $disabled        = "disabled";
                                $helpIcon        = '<a href="#" class="dismissable-popover" data-toggle="popover" data-content="' . __('family-members.cant_change_own_login') . '"><span class="fa fa-question-circle"></span></a>';
                            }
                        @endphp

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="allow_login" name="allow_login" {{ ($member->allow_login) ? "checked" : "" }} {{ $disabled }}>
                            {!! $dummyAllowLogin !!}
                            {!! $helpIcon !!}
                            <label class="form-check-label" for="allow_login">
                                {{ __('family-members.allow_to_log_in') }}
                            </label>
                        </div>

                        <div class="collapse" id="loginDetails">

                            <div class="form-group">
                                <label for="login_email">{{ __('family-members.login_email') }}</label>
                                <input type="text" name="login_email" id="login_email" class="form-control" placeholder="{{ __('family-members.login_email') }}" value="{{ old('login_email', $member->login_email) }}">
                                @fieldError('login_email')
                            </div>

                            <hr>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="is_administrator" name="is_administrator" {{ ($member->is_administrator) ? "checked" : "" }} >
                                <label class="form-check-label" for="is_administrator">
                                    {{ __('family-members.administrator') }}
                                </label>
                                - {{ __('family-members.administrator_desc') }}
                            </div>

                        </div>

                    </fieldset>

                </div>

            </div>

            <hr>

            <button type="submit" class="btn btn-primary">
                {{ __('form.save') }}
            </button>

            <a class="btn btn-secondary" href="{{ $cancelRoute }}">
                {{ __('form.cancel') }}
            </a>

        </div>

    </div>

</form>
