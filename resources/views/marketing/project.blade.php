@extends('layouts.marketing')

@section('marketing')

    <div class="text-center">

        <h1>{{ __('marketing.project') }}</h1>
        <h3 class="text-muted">{{ __('marketing.project-hook') }}</h3>

        <hr>

    </div>

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 project-details">

            <p class="text-center">
                <span class="fa-stack fa-3x">
                    <span class="fa fa-circle fa-stack-2x color-red"></span>
                    <span class="fa fa-heart fa-stack-1x color-white"></span>
                </span>
            </p>

            <p>
                {!! __('marketing.project-intro') !!}
            </p>

            <div class="card shadow">

                <div class="card-body">
                    <h3 class="text-centssser">
                        <span class="fa-stack fa-1x">
                            <span class="fa fa-circle fa-stack-2x color-green"></span>
                            <span class="fa fa-usd fa-stack-1x color-white"></span>
                        </span>
                        {{ __('marketing.money-matters') }}
                    </h3>

                    <p>
                        {!! __('marketing.project-money-matters') !!}
                    </p>
                </div>

            </div>

        </div>

        <div class="col-12 col-md-10 project-faqs">

            <hr>

            <h3>{{ __('marketing.project') }} {{ __('application.faqs') }}</h3>

            <dl>

                <dt>{{ __('marketing.project-faqs.really-free') }}</dt>
                <dd>{!! __('marketing.project-faqs.really-free-a') !!}</dd>

                <dt>{{ __('marketing.project-faqs.open-source-mean') }}</dt>
                <dd>{!! __('marketing.project-faqs.open-source-mean-a') !!}</dd>

                <dt>{{ __('marketing.project-faqs.why-open-source') }}</dt>
                <dd>{!! __('marketing.project-faqs.why-open-source-a') !!}</dd>

                <dt>{{ __('marketing.project-faqs.why-name') }}</dt>
                <dd>{!! __('marketing.project-faqs.why-name-a') !!}</dd>

                <dt>{{ __('marketing.project-faqs.why-name-piglet') }}</dt>
                <dd>{!! __('marketing.project-faqs.why-name-piglet-a') !!}</dd>

                <dt>{{ __('marketing.project-faqs.really-faqs') }}</dt>
                <dd>{!! __('marketing.project-faqs.really-faqs-a') !!}</dd>

            </dl>

        </div>

    </div>

@endsection
