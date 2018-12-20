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

    @meta('og:title', e(config('app.name')))
    @meta('og:type', 'website')
    @meta('og:image', asset('img/cartoon_family_fullsize.jpg'))
    @meta('og:url', config('app.url'))

    @stack('meta')

    <title>{{ config('app.name', 'Piglet') }} @yield('title')</title>

    {{-- Scripts --}}
    @routes
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

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
    @stack('stylesheets')
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route("homepage") }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("project") }}">{{ __('marketing.project') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("pricing") }}">{{ __('marketing.pricing') }}</a>
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
                            {{ __('application.home') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                            {!! Auth::user()->icon(['icon', 'user-photo']) !!}
                            {{ Auth::user()->firstName }}
                        </a>
                        <div class="dropdown-menu user-options-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route("user-settings") }}">
                                <span class="fa fa-cogs fa-fw" aria-hidden="true"></span> {{ __('application.settings') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route("help") }}">
                                <span class="fa fa-question-circle fa-fw"></span> {{ __('application.help') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('terms-of-use') }}">
                                <span class="fa fa-institution fa-fw" aria-hidden="true"></span> {{ __('application.terms-of-use') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('privacy') }}">
                                <span class="fa fa-shield fa-fw" aria-hidden="true"></span> {{ __('application.privacy-policy') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route("logout") }}">
                                <span class="fa fa-sign-out fa-fw" aria-hidden="true"></span> {{ __('application.log-out') }}
                            </a>
                        </div>
                    </li>
                @endauth

                {{-- $this check is to tell if we're rendering a HTTP error page. The session middleware may not have
                    run so we won't be able to tell if there's a user or not and it looks really silly if the user is
                    logged in and they have the option to log in or register --}}
                @if (!isset($exception))

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("register") }}"><span class="fa fa-user-plus"></span> {{ __('application.register') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("login") }}"><span class="fa fa-sign-in"></span> {{ __('application.log-in') }}</a>
                        </li>
                    @endguest

                @endif
            </ul>

        </div>
    </nav>

    <div id="applicationModal" class="modal fade " tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg shadow-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalTitle" data-default-title="{{ config('app.name') }}"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="main container shadow">

        @yield('content')

    </div>

    @stack('scripts')

    @php
        // This is how long each notification should remain on the screen before fading (0 means event to dismiss)
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
