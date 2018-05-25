<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    {{-- Scripts --}}
    @routes
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    {{--<link rel="dns-prefetch" href="https://fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet" type="text/css">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheets')
</head>
<body>

    {{--<div class="header container-fluid">
        <div class="row">

            <div class="col">
                <span class="fa fa-users"></span> <span class="d-none d-sm-inline">Family</span> <span class="fa fa-caret-down"></span>
            </div>

            <div class="col text-right">
                <span class="fa fa-user-circle"></span> <span class="d-none d-sm-inline">User</span> <span class="fa fa-caret-down"></span>
            </div>

        </div>
    </div>--}}

    <nav class="navbar navbar-expand navbar-dark bg-dark">
        {{--<a class="navbar-brand" href="#">Navbar</a>--}}
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("home") }}"><span class="fa fa-home"></span> Home</a>
                </li>
            </ul>

            @auth
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                            {!! Auth::user()->icon(['icon', 'user-photo']) !!}
                            {{ Auth::user()->firstName }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route("user-settings") }}">
                                <span class="fa fa-cogs"></span> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route("logout") }}">
                                <span class="fa fa-sign-out"></span> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            @endauth

        </div>
    </nav>

    <div class="main container shadow">

        @yield('content')

    </div>

    @yield('scripts')

</body>
</html>
