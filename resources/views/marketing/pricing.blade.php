@extends('layouts.marketing')

@section('marketing')

    <div class="text-center">

        <h1>{{ __('marketing.pricing') }}</h1>
        <h3 class="text-muted">{{ __('marketing.pricing-hook') }}</h3>

        <hr>

    </div>

    <div class="row justify-content-center">


        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">

            @include ('marketing.shared._pricing-card')

        </div>

        <div class="col-12 col-md-10 pricing-faqs">

            <hr>

            <h3>{{ __('marketing.pricing') }} {{ __('application.faqs') }}</h3>

            <dl>

                <dt>{{ __('marketing.pricing-faqs.really-free') }}</dt>
                <dd>{{ __('marketing.pricing-faqs.really-free-a') }}</dd>

                <dt>{{ __('marketing.pricing-faqs.why') }}</dt>
                <dd>{!! __('marketing.pricing-faqs.why-a') !!}</dd>

                <dt>{{ __('marketing.pricing-faqs.why-pricing-page') }}</dt>
                <dd>{{ __('marketing.pricing-faqs.why-pricing-page-a') }}</dd>

                <dt>{{ __('marketing.pricing-faqs.operation-costs') }}</dt>
                <dd>{{ __('marketing.pricing-faqs.operation-costs-a') }}</dd>

                <dt>{{ __('marketing.pricing-faqs.ever-cost') }}</dt>
                <dd>{!! __('marketing.pricing-faqs.ever-cost-a') !!}</dd>

                <dt>{{ __('marketing.pricing-faqs.pretty-cool') }}</dt>
                <dd>{{ __('marketing.pricing-faqs.pretty-cool-a') }}</dd>

            </dl>

        </div>

    </div>

@endsection
