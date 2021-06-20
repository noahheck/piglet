{{--@push('scripts')
    <script type="text/javascript" src="{{ mix('js/family.events._form.js') }}"></script>
@endpush--}}

<form name="event" action="{{ $action }}" method="POST" class="has-bold-labels" autocomplete="off">

    @csrf

    @if ($method)
        @method($method)
    @endif

    <input type="hidden" name="return" value="{{ old('return', url()->previous()) }}">

    @formError

    <ul class="nav nav-tabs" id="contactTabs" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">{{ __('contacts.details') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contactTab" data-toggle="tab" href="#contactInfo" role="tab" aria-controls="contact" aria-selected="false">{{ __('contacts.contactInfo') }}</a>
        </li>

    </ul>


    <div class="tab-content" id="contactTabsContent">

        <div class="tab-pane show active fade" id="details" role="tabpanel" aria-labelledby="detailsTab">

            <fieldset>

                <legend>{{ __('contacts.details') }}</legend>

                <div class="form-group">
                    <label for="title">{{ __('contacts.firstName') }}</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="{{ __('contacts.firstName') }}" value="{{ old('first_name', $contact->first_name) }}" autofocus>
                    @fieldError('first_name')
                </div>

                <div class="form-group">
                    <label for="title">{{ __('contacts.middleName') }}</label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="{{ __('contacts.middleName') }}" value="{{ old('middle_name', $contact->middle_name) }}">
                    @fieldError('middle_name')
                </div>

                <div class="form-group">
                    <label for="title">{{ __('contacts.lastName') }}</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="{{ __('contacts.lastName') }}" value="{{ old('last_name', $contact->last_name) }}">
                    @fieldError('last_name')
                </div>


                <div class="row">

                    <div class="col-6">

                        <div class="form-group">
                            <label for="birthdate">{{ __('contacts.birthdate') }} <small class="text-muted">mm/dd/yyyy</small></label>
                            <input type="text" name="birthdate" id="birthdate" class="form-control datepicker" placeholder="{{ __('contacts.birthdate') }}" value="{{ old('birthdate', $contact->birthdate) }}">
                            @fieldError('birthdate')
                        </div>

                    </div>

                </div>

            </fieldset>

        </div>


        <div class="tab-pane fade" id="contactInfo" role="tabpanel" aria-labelledby="contactTab">

            <fieldset>
                <legend>{{ __('contacts.contactInfo') }}</legend>

                <div class="form-group">
                    <label for="phone">{{ __('contacts.phone') }}</label>
                    <input type="text" name="phone" id="phone" class="form-control phone-field" placeholder="{{ __('contacts.phone') }}" value="{{ old('phone', $contact->phone) }}">
                    @fieldError('phone')
                </div>

                <div class="form-group">
                    <label for="secondaryPhone">{{ __('contacts.secondaryPhone') }}</label>
                    <input type="text" name="secondaryPhone" id="secondaryPhone" class="form-control phone-field" placeholder="{{ __('contacts.secondaryPhone') }}" value="{{ old('secondaryPhone', $contact->secondaryPhone) }}">
                    @fieldError('secondaryPhone')
                </div>

                <div class="form-group">
                    <label for="address1">{{ __('contacts.address1') }}</label>
                    <input type="text" name="address1" id="address1" class="form-control" placeholder="{{ __('contacts.address1') }}" value="{{ old('address1', $contact->address1) }}">
                    @fieldError('address1')
                </div>

                <div class="form-group">
                    <label for="address2">{{ __('contacts.address2') }}</label>
                    <input type="text" name="address2" id="address2" class="form-control" placeholder="{{ __('contacts.address2') }}" value="{{ old('address2', $contact->address2) }}">
                    @fieldError('address2')
                </div>

                <div class="form-group">
                    <label for="city">{{ __('contacts.city') }}</label>
                    <input type="text" name="city" id="city" class="form-control" placeholder="{{ __('contacts.city') }}" value="{{ old('city', $contact->city) }}">
                    @fieldError('city')
                </div>

                <div class="row">

                    <div class="col-7">

                        <div class="form-group">
                            <label for="state">{{ __('contacts.state') }}</label>
                            <input type="text" name="state" id="state" class="form-control" placeholder="{{ __('contacts.state') }}" value="{{ old('state', $contact->state) }}">
                            @fieldError('state')
                        </div>

                    </div>

                    <div class="col-5">

                        <div class="form-group">
                            <label for="zip">{{ __('contacts.zip') }}</label>
                            <input type="text" name="zip" id="zip" class="form-control" placeholder="{{ __('contacts.zip') }}" value="{{ old('zip', $contact->zip) }}">
                            @fieldError('zip')
                        </div>

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

</form>
