@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.merchants._form.js') }}"></script>
@endpush

@php
$categories = \App\Family\Category::where('active', true)->orderBy('d_order')->get();
@endphp

<form name="merchant" action="{{ $action }}" method="POST" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    @formError

    <ul class="nav nav-tabs" id="merchantTabs" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">{{ __('merchants.details') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contactTab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{ __('merchants.contact') }}</a>
        </li>

    </ul>

    <div class="tab-content" id="merchantTabsContent">

        <div class="tab-pane show active fade" id="details" role="tabpanel" aria-labelledby="detailsTab">

            <fieldset>
                <legend>{{ __('merchants.merchant-details') }}</legend>

                <div class="form-group">
                    <label for="name">{{ __('merchants.name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('merchants.name') }}" value="{{ old('name', $merchant->name) }}">
                    @fieldError('name')
                </div>

                {{--
                    This is where I should put the recurring checkbox when I get there
                --}}

                <div class="form-group">
                    <label for="default_category_id">{{ __('merchants.default-category') }}</label>
                    <select class="custom-select" name="default_category_id" id="default_category_id">
                        <option value="">--</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" data-options="{{ implode('|', $category->sub_categories) }}" {{ (old('default_category_id', ($merchant->defaultCategory) ? $merchant->defaultCategory->id : '') == $category->id) ? "selected" : "" }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="default_sub_category">{{ __('merchants.default-sub-category') }}</label>
                    <select class="custom-select" name="default_sub_category" id="default_sub_category">
                        <option value="">--</option>
                        @if (old('default_sub_category', $merchant->default_sub_category))
                            <option selected value="{{ old('default_sub_category', $merchant->default_sub_category) }}">{{ old('default_sub_category', $merchant->default_sub_category) }}</option>
                        @endif
                        {{--@foreach ($categories as $category)
                            @if ($category->sub_categories)
                                @foreach ($category->sub_categories as $subCategory)
                                    <option class="sub-category" data-category-id="{{ $category->id }}" value="{{ $subCategory }}" {{ (old('default_sub_category', ($merchant->default_sub_category) ? $merchant->default_sub_category : '') == $subCategory) ? "selected" : "" }}>{{ $subCategory }}</option>
                                @endforeach
                            @endif
                        @endforeach--}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="merchantDetails">{{ __('merchants.details') }}</label>
                    <textarea name="details" id="merchantDetails" class="form-control" placeholder="{{ __('merchants.details-desc') }}" rows="6">{{ old('details', $merchant->details) }}</textarea>
                    @fieldError('details')
                </div>

            </fieldset>

        </div>

        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contactTab">

            <fieldset>
                <legend>{{ __('merchants.contact-information') }}</legend>

                <div class="form-group">
                    <label for="phone">{{ __('merchants.phone') }}</label>
                    <input type="text" name="phone" id="phone" class="form-control phone-field" placeholder="{{ __('merchants.phone') }}" value="{{ old('phone', $merchant->phone) }}">
                    @fieldError('phone')
                </div>

                <div class="form-group">
                    <label for="secondaryPhone">{{ __('merchants.secondaryPhone') }}</label>
                    <input type="text" name="secondaryPhone" id="secondaryPhone" class="form-control phone-field" placeholder="{{ __('merchants.secondaryPhone') }}" value="{{ old('secondaryPhone', $merchant->secondaryPhone) }}">
                    @fieldError('secondaryPhone')
                </div>

                <div class="form-group">
                    <label for="url">{{ __('merchants.website') }}</label>
                    <input type="text" name="url" id="url" class="form-control" placeholder="{{ __('merchants.website') }}" value="{{ old('url', $merchant->url) }}">
                    @fieldError('url')
                </div>

                <div class="form-group">
                    <label for="address1">{{ __('merchants.address1') }}</label>
                    <input type="text" name="address1" id="address1" class="form-control" placeholder="{{ __('merchants.address1') }}" value="{{ old('address1', $merchant->address1) }}">
                    @fieldError('address1')
                </div>

                <div class="form-group">
                    <label for="address2">{{ __('merchants.address2') }}</label>
                    <input type="text" name="address2" id="address2" class="form-control" placeholder="{{ __('merchants.address2') }}" value="{{ old('address2', $merchant->address2) }}">
                    @fieldError('address2')
                </div>

                <div class="form-group">
                    <label for="city">{{ __('merchants.city') }}</label>
                    <input type="text" name="city" id="city" class="form-control" placeholder="{{ __('merchants.city') }}" value="{{ old('city', $merchant->city) }}">
                    @fieldError('city')
                </div>

                <div class="form-group">
                    <label for="state">{{ __('merchants.state') }}</label>
                    <input type="text" name="state" id="state" class="form-control" placeholder="{{ __('merchants.state') }}" value="{{ old('state', $merchant->state) }}">
                    @fieldError('state')
                </div>

                <div class="form-group">
                    <label for="zip">{{ __('merchants.zip') }}</label>
                    <input type="text" name="zip" id="zip" class="form-control" placeholder="{{ __('merchants.zip') }}" value="{{ old('zip', $merchant->zip) }}">
                    @fieldError('zip')
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
