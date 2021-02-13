@extends('layouts.marketing')

@section('marketing')

    <div class="jumbotron homepage-jumbotron">


        <div class="row">
            <div class="col-12 col-md-6 order-md-2">
                <img class="img-fluid rounded-circle" src="{{ asset('img/cartoon_family_fullsize.jpg') }}" alt="{{ config('app.name') }}">
            </div>
            <div class="col-12 col-md-6 order-md-1">

                <div class="jumbotron-content text-center">

                    <h1>{{ __('marketing.welcome-to-appName') }}</h1>

                    <hr>

                    <h3>{{ __('marketing.hook') }}</h3>

                </div>

                <p class="text-center">
                    <span class="fa-stack fa-3x">
                        <span class="fa fa-circle fa-stack-2x color-green"></span>
                        <span class="fa fa-dollar fa-stack-1x color-white"></span>
                    </span>
                    <span class="fa-stack fa-3x">
                        <span class="fa fa-circle fa-stack-2x color-red"></span>
                        <span class="fa fa-calendar fa-stack-1x color-white"></span>
                    </span>
                    <span class="fa-stack fa-3x">
                        <span class="fa fa-circle fa-stack-2x color-blue"></span>
                        <span class="fa fa-check-square-o fa-stack-1x color-white"></span>
                    </span>
                </p>

                <hr>

                @auth
                    <p class="text-center">
                        <a class="btn btn-primary btn-lg" href="{{ route("home") }}">
                            <span class="fa-stack" aria-hidden="true">
                                <span class="fa fa-square-o fa-stack-2x"></span>
                                <span class="fa fa-home fa-stack-1x"></span>
                            </span>
                            {{ __('application.home') }}
                        </a>
                    </p>
                @endauth

                @guest

                    <h4 class="text-center">
                        {{ __('marketing.ready-to-start') }}
                    </h4>

                    <p class="text-center">
                        <a class="btn btn-primary btn-lg" href="{{ route('register') }}">
                            <span class="fa fa-user-plus"></span>
                            {{ __('marketing.sign-up-now') }}
                        </a>
                        <a class="btn btn-primary btn-lg" href="{{ route('login') }}">
                            <span class="fa fa-sign-in"></span>
                            {{ __('application.log-in') }}
                        </a>
                    </p>

                @endguest

            </div>

        </div>

    </div>

    <h2 class="p-2 pl-4 bg-purple color-white">{{ __('marketing.pricing') }}</h2>

    <div class="row pb-2 justify-content-center pricing-section">

        <div class="col-12 col-md-6 col-lg-5 pt-md-3">

            <p class="lead">
                {{ __('marketing.greatest-hope-offer-free') }}
            </p>

            <p>
                {!! __('marketing.more-info-pricing') !!}
            </p>

        </div>

        <div class="col-12 col-md-6 col-lg-4">
            @include ('marketing.shared._pricing-card')
        </div>

    </div>

    <h2 class="p-2 pl-4 bg-blue color-white">{{ __('marketing.features') }}</h2>

    <div class="row mt-5 border shadow-sm pb-5 m-1 feature-set">

        <div class="col-12">
            <h3 class="pb-4 pt-4">{{ __('marketing.calendar') }}</h3>
        </div>

        <div class="col-12 col-md-6">
            <div class="card shadow p-3">
                <img class="card-img" src="{{ asset('img/marketing/calendar.png') }}" alt="">
            </div>
        </div>

        <div class="col-12 col-md-6 pt-3 pt-md-0">
            {!! __('marketing.calendar-desc') !!}
        </div>

    </div>



    <div class="row mt-5 border shadow-sm pb-5 m-1 feature-set">

        <div class="col-12">
            <h3 class="pb-4 pt-4">{{ __('marketing.todo-lists') }}</h3>
        </div>

        <div class="col-12 col-md-6 order-2 order-md-3">
            <div class="card p-3 border-0">
                <img class="card-img" src="{{ asset('img/marketing/to-dos.png') }}" alt="">
            </div>
        </div>

        <div class="col-12 col-md-6 pt-3 pt-md-0 order-3 order-md-2">
            {!! __('marketing.todo-lists-desc') !!}
        </div>

    </div>










    <div class="row mt-5 border shadow-sm pb-3 m-1 feature-set justify-content-around">

        <div class="col-12">

            <h3 class="pb-4 pt-4">{{ __('marketing.money-matters') }}</h3>

            {!! __('marketing.money-matters-desc') !!}

        </div>

        <div class="col-6 col-md-5 col-lg-3">
            <div class="card shadow mb-5">
                <img class="card-img p-3 border-bottom" src="{{ asset('img/marketing/organize.png') }}" alt="">
                <div class="card-body text-center">
                    <h5>
                        <span class="fa fa-list-ul"></span>
                        {{ __('marketing.money-matters-features.organize') }}
                    </h5>
                    <p class="card-text">
                        {{ __('marketing.money-matters-features.organize-desc') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-5 col-lg-3">
            <div class="card shadow mb-5">
                <img class="card-img p-3 border-bottom" src="{{ asset('img/marketing/plan.png') }}" alt="">
                <div class="card-body text-center">
                    <h5>
                        <span class="fa fa-arrow-circle-right"></span>
                        {{ __('marketing.money-matters-features.plan') }}
                    </h5>
                    <p class="card-text">
                        {{ __('marketing.money-matters-features.plan-desc') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-5 col-lg-3">
            <div class="card shadow mb-5">
                <img class="card-img p-3 border-bottom" src="{{ asset('img/marketing/track.png') }}" alt="">
                <div class="card-body text-center">
                    <h5>
                        <span class="fa fa-bar-chart"></span>
                        {{ __('marketing.money-matters-features.track') }}
                    </h5>
                    <p class="card-text">
                        {{ __('marketing.money-matters-features.track-desc') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-5 col-lg-3">
            <div class="card shadow mb-5">
                <img class="card-img p-3 border-bottom" src="{{ asset('img/marketing/save.png') }}" alt="">
                <div class="card-body text-center">
                    <h5>
                        <span class="fa fa-line-chart"></span>
                        {{ __('marketing.money-matters-features.save') }}
                    </h5>
                    <p class="card-text">
                        {{ __('marketing.money-matters-features.save-desc') }}
                    </p>
                </div>
            </div>
        </div>

        {{--<div class="col-12">

            {!! __('marketing.money-matters-more-info') !!}

        </div>--}}


    </div>



@endsection
