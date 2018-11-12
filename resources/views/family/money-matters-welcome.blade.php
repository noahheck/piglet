@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('money-matters.money-matters') }} - {{ __('money-matters.welcome') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.money-matters.welcome.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.money-matters.welcome.js') }}"></script>
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
        ],
        'location'   => __('money-matters.welcome'),
    ])

    <form action="{{ route('family.money-matters-welcome-assemble', [$family]) }}" method="POST" class="has-bold-labels">

        @csrf

        <div class="row justify-content-center first-run-wizard">

            @foreach (range(1, 5) as $page)

                <div class="col-12 col-md-10 wizard-page" id="wizard_page_{{ $page }}">
                    @include ("family.money-matters-welcome.page_$page")
                </div>

            @endforeach


            <div class="col-12 col-md-10 mt-5 wizard-navigation text-center">

                <hr>

                <button class="btn btn-secondary wizard-navigation-button" type="button" id="wizard_button_back">
                    <span class="fa fa-chevron-left"></span> {{ __('form.back') }}
                </button>
                <button class="btn btn-primary wizard-navigation-button" type="button" id="wizard_button_forward">
                    {{ __('form.next') }} <span class="fa fa-chevron-right"></span>
                </button>

            </div>

                {{--<form class="has-bold-labels" name="money-matters-settings" action="{{ route('family.money-matters.settings-save', [$family, 'return' => url()->previous()]) }}" method="POST">

                    @csrf

                    @formError

                    <div class="card shadow mb-3">
                        <div class="card-body">

                            <h3>{{ __('money-matters.monthly-default-amounts') }}</h3>

                            <p>{{ __('money-matters.monthly-default-amounts-description') }}</p>

                            <hr style="width: 90%;">

                            <div class="form-group">
                                <label for="{{ App\Family::MONEY_MATTERS_EMERGENCY_FUND_AMOUNT }}">{{ __('money-matters.emergency-fund-label') }}</label>
                                <p>{{ __('money-matters.emergency-fund-description') }}</p>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                                    </div>
                                    <input type="text" name="{{ App\Family::MONEY_MATTERS_EMERGENCY_FUND_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_EMERGENCY_FUND_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.pocket-money-label') }}" value="{{ old($family::MONEY_MATTERS_EMERGENCY_FUND_AMOUNT, App\formatCurrency($family->getSetting($family::MONEY_MATTERS_EMERGENCY_FUND_AMOUNT), false)) }}">
                                </div>
                                @fieldError('{{ App\Family::MONEY_MATTERS_EMERGENCY_FUND_AMOUNT }}')
                            </div>

                            <hr style="width: 90%;">

                            <div class="form-group">
                                <label for="{{ App\Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT }}">{{ __('money-matters.pocket-money-label') }}</label>
                                <p>{{ __('money-matters.pocket-money-description') }}</p>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                                    </div>
                                    <input type="text" name="{{ App\Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.pocket-money-label') }}" value="{{ old($family::MONEY_MATTERS_POCKET_MONEY_AMOUNT, App\formatCurrency($family->getSetting($family::MONEY_MATTERS_POCKET_MONEY_AMOUNT), false)) }}">
                                </div>
                                @fieldError('{{ App\Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT }}')
                            </div>

                            <hr style="width: 90%;">

                            <div class="form-group">
                                <label for="{{ App\Family::MONEY_MATTERS_RETIREMENT_AMOUNT }}">{{ __('money-matters.retirement-label') }}</label>
                                <p>{{ __('money-matters.retirement-description') }}</p>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                                    </div>
                                    <input type="text" name="{{ App\Family::MONEY_MATTERS_RETIREMENT_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_RETIREMENT_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.retirement-label') }}" value="{{ old($family::MONEY_MATTERS_RETIREMENT_AMOUNT, App\formatCurrency($family->getSetting($family::MONEY_MATTERS_RETIREMENT_AMOUNT), false)) }}">
                                </div>
                                @fieldError('{{ App\Family::MONEY_MATTERS_RETIREMENT_AMOUNT }}')
                            </div>

                            <hr style="width: 90%;">

                            <div class="form-group">
                                <label for="{{ App\Family::MONEY_MATTERS_EDUCATION_AMOUNT }}">{{ __('money-matters.education-label') }}</label>
                                <p>{{ __('money-matters.education-description') }}</p>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                                    </div>
                                    <input type="text" name="{{ App\Family::MONEY_MATTERS_EDUCATION_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_EDUCATION_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.education-label') }}" value="{{ old($family::MONEY_MATTERS_EDUCATION_AMOUNT, App\formatCurrency($family->getSetting($family::MONEY_MATTERS_EDUCATION_AMOUNT), false)) }}">
                                </div>
                                @fieldError('{{ App\Family::MONEY_MATTERS_EDUCATION_AMOUNT }}')
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ __('form.save') }}
                    </button>

                    <a class="btn btn-secondary" href="{{ url()->previous() }}">
                        {{ __('form.cancel') }}
                    </a>

                </form>--}}


        </div>

    </form>

@endsection
