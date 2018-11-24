@extends('layouts.app')


@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/marketing.css') }}" />
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
                    <a href="{{ route('project') }}">Project</a>
                </li>
                <li>
                    <a href="{{ route('pricing') }}">Pricing</a>
                </li>
            </ul>
        </div>
        <div class="col-12 col-sm-6 text-right">
            <p>
                &copy; {{ date('Y') }} - Noah Heck and Contributors
            </p>
            <p>
                {{ config('app.name') }} is proud to be an open-source project - Find out more at: <a href="https://github.com/noahheck/piglet" target="_blank">https://github.com/noahheck/piglet</a>
            </p>
        </div>
    </div>

@endsection
