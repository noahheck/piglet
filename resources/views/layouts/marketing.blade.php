@extends('layouts.app')


@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/marketing.css') }}" />
@endpush

@section('content')

    @yield('marketing')

    <hr>

    <div class="row">
        <div class="col-12 col-sm-6">
            <ul>
                <li>
                    <a href="{{ route('homepage') }}">{{ config('app.name') }}</a>
                </li>
                <li>
                    <a href="{{ route('project') }}">{{ __('marketing.project') }}</a>
                </li>
                <li>
                    <a href="{{ route('pricing') }}">{{ __('marketing.pricing') }}</a>
                </li>
                <li>
                    <a href="{{ route('help') }}">{{ __('application.help') }}</a>
                </li>
                <li>
                    <a href="{{ route('terms-of-use') }}">{{ __('application.terms-of-use') }}</a>
                </li>
                <li>
                    <a href="{{ route('privacy') }}">{{ __('application.privacy-policy') }}</a>
                </li>
            </ul>
        </div>
        <div class="col-12 col-sm-6 text-right">
            <p>
                {!! __('application.copyright') !!}
            </p>
            <p>
                {!! __('application.proud-open-source') !!}
            </p>
        </div>
    </div>

@endsection
