<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    {{-- CSRF Token --}}
    @meta('csrf-token', csrf_token())

    @if(isset($family))
        @meta('family-id', $family->id)
    @endif

    @stack('meta')

    <title>{{ config('app.name', 'Piglet') }} @yield('title')</title>

    {{-- Scripts --}}
    @routes
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    {{--<script src="{{ mix('js/app.js') }}"></script>--}}

    {{--<!-- Fonts -->--}}
    {{--<link rel="dns-prefetch" href="https://fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet" type="text/css">--}}

    <!-- ****** faviconit.com favicons ****** -->
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
    <link rel="icon" sizes="16x16 32x32 64x64" href="{{ asset('favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="196x196" href="{{ asset('favicon/favicon-192.png') }}">
    <link rel="icon" type="image/png" sizes="160x160" href="{{ asset('favicon/favicon-160.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('favicon/favicon-64.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon/favicon-57.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/favicon-114.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/favicon-72.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/favicon-144.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/favicon-60.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/favicon-120.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/favicon-76.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/favicon-152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/favicon-180.png') }}">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/favicon-144.png') }}">
    <meta name="msapplication-config" content="{{ asset('favicon/browserconfig.xml') }}">
    <!-- ****** faviconit.com favicons ****** -->

    {{--<!-- Styles -->--}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/print.css') }}" rel="stylesheet">
    @stack('stylesheets')
</head>
<body class="print-body">

    <div class="print-options">

        @yield('print-options')

        <div class="pull-right">
            <button type="button" class="btn btn-primary" onclick="window.print();">
                <span class="fa fa-print"></span> Print
            </button>
        </div>

    </div>

    <div class="container-fluid">

        @yield('content')

    </div>

    @stack('scripts')

</body>
</html>
