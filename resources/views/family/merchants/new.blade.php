@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Merchants
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => 'Money Matters',
            route('family.merchants.index', [$family]) => 'Merchants',
        ],
        'location'   => 'Create New',
    ])
        {{--'menu' => [
            ['type' => 'link', 'href' => route('family.merchants.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add New Merchant'],
        ]--}}

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            <form name="merchant" action="{{ route('family.merchants.store', [$family]) }}" method="POST" class="has-bold-labels">

                @csrf

                @formError

                <ul class="nav nav-tabs" id="merchantTabs" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contactTab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li>

                </ul>

                <div class="tab-content" id="merchantTabsContent">

                    <div class="tab-pane show active fade" id="details" role="tabpanel" aria-labelledby="detailsTab">

                        <fieldset>
                            <legend>Merchant Details</legend>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name', $merchant->name) }}">
                                @fieldError('name')
                            </div>

                            {{--
                                This is where I should put the recurring checkbox and the default category, when I get there
                            --}}

                            <div class="form-group">
                                <label for="merchantDetails">Details</label>
                                <textarea name="details" id="merchantDetails" class="form-control" placeholder="Merchant Details, Notes, etc..." rows="6">{{ old('details', $merchant->details) }}</textarea>
                                @fieldError('details')
                            </div>

                        </fieldset>

                    </div>

                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contactTab">

                        <fieldset>
                            <legend>Contact Information</legend>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control phone-field" placeholder="Phone" value="{{ old('phone', $merchant->phone) }}">
                                @fieldError('phone')
                            </div>

                            <div class="form-group">
                                <label for="secondarPhone">Secondary Phone</label>
                                <input type="text" name="secondaryPhone" id="secondaryPhone" class="form-control phone-field" placeholder="Secondary Phone" value="{{ old('secondaryPhone', $merchant->secondaryPhone) }}">
                                @fieldError('secondaryPhone')
                            </div>

                            <div class="form-group">
                                <label for="url">Website</label>
                                <input type="text" name="url" id="url" class="form-control" placeholder="Website" value="{{ old('url', $merchant->url) }}">
                                @fieldError('url')
                            </div>

                            <div class="form-group">
                                <label for="address1">Address Line 1</label>
                                <input type="text" name="address1" id="address1" class="form-control" placeholder="Address Line 1" value="{{ old('address1', $merchant->address1) }}">
                                @fieldError('address1')
                            </div>

                            <div class="form-group">
                                <label for="address2">Address Line 2</label>
                                <input type="text" name="address2" id="address2" class="form-control" placeholder="Address Line 2" value="{{ old('address2', $merchant->address2) }}">
                                @fieldError('address2')
                            </div>

                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{ old('city', $merchant->city) }}">
                                @fieldError('city')
                            </div>

                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state" class="form-control" placeholder="State" value="{{ old('state', $merchant->state) }}">
                                @fieldError('state')
                            </div>

                            <div class="form-group">
                                <label for="zip">Zip</label>
                                <input type="text" name="zip" id="zip" class="form-control" placeholder="Zip" value="{{ old('zip', $merchant->zip) }}">
                                @fieldError('zip')
                            </div>

                        </fieldset>

                    </div>

                </div>

                <hr>

                <button type="submit" class="btn btn-primary">
                    {{ __('form.save') }}
                </button>

                <a class="btn btn-secondary" href="{{ route('family.merchants.index', [$family]) }}">
                    {{ __('form.cancel') }}
                </a>

            </form>

        </div>

    </div>

@endsection
