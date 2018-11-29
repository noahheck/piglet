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
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    {{--<!-- Fonts -->--}}
    {{--<link rel="dns-prefetch" href="https://fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet" type="text/css">--}}

    {{--<!-- Styles -->--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('stylesheets')
</head>
<body>

    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("homepage") }}"><span class="fa fa-home"></span> {{ config('app.name') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("project") }}">Project</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("pricing") }}">Pricing</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("home") }}">
                            <span class="fa-stack" aria-hidden="true">
                                <span class="fa fa-square-o fa-stack-2x"></span>
                                <span class="fa fa-home fa-stack-1x"></span>
                            </span>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                            {!! Auth::user()->icon(['icon', 'user-photo']) !!}
                            {{ Auth::user()->firstName }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route("user-settings") }}">
                                <span class="fa fa-cogs fa-fw" aria-hidden="true"></span> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('terms-of-use') }}">
                                <span class="fa fa-institution fa-fw aria-hidden="true""></span> Terms of Use
                            </a>
                            <a class="dropdown-item" href="{{ route('privacy') }}">
                                <span class="fa fa-shield fa-fw aria-hidden="true""></span> Privacy Policy
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route("logout") }}">
                                <span class="fa fa-sign-out fa-fw aria-hidden="true""></span> Logout
                            </a>
                        </div>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("register") }}"><span class="fa fa-user-plus"></span> Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("login") }}"><span class="fa fa-sign-in"></span> Login</a>
                    </li>
                @endguest
            </ul>

        </div>
    </nav>

    <div class="main container shadow">

        @yield('content')

    </div>

    @stack('scripts')

    @php
        $flashMessages = [
            'error'   => '0',
            'warning' => '0',
            'info'    => '12000',
            'success' => '4000',
        ];
    @endphp

    <script type="text/javascript">
        @foreach ($flashMessages as $category => $duration)
            @if (session($category))
                @if (is_array(session($category)))
                    @foreach (session($category) as $message)
                        createNotification({theme: '{{ $category }}', showDuration: {{ $duration }} })({message: "{{ $message }}"});
                    @endforeach
                @else
                    createNotification({theme: '{{ $category }}', showDuration: {{ $duration }} })({message: "{{ session($category) }}"});
                @endif
            @endif
        @endforeach
    </script>

</body>
</html>
