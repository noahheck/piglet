@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('money-matters.money-matters') }} - {{ __('money-matters.welcome') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.money-matters.welcome.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/family.money-matters.welcome.js') }}"></script>
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
        ],
        'location'   => __('money-matters.welcome'),
    ])


    <form action="{{ route('family.money-matters-welcome-assemble', [$family]) }}" method="POST" class="has-bold-labels">

        <div class="row justify-content-center first-run-wizard">


            @csrf

            @foreach (range(1, 7) as $page)

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


                <button type="submit" class="btn btn-primary btn-success wizard-navigation-button" id="wizard_button_finish">
                    {{ __('form.finish') }}
                </button>

            </div>

        </div>

    </form>

@endsection
