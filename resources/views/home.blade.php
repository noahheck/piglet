@extends('layouts.app')


@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endpush

@section('content')

    <div class="row">

        <div class="col">

            @formSuccess('family.create-success')

            <h2>Welcome Home!</h2>

            <hr>

            @if ($invitations->count())
                <div class="row justify-content-center">

                    <div class="col-12 col-sm-10 col-md-8 col-lg-6">

                        <div class="card">

                            <div class="card-header">
                                {{ __('family-settings.invited_to_family') }}:
                            </div>
                            <div class="card-body">


                                @foreach ($invitations as $invitation)

                                    @if (!$loop->first)
                                        <hr>
                                    @endif

                                    <div class="invitation">
                                        <h4>{{ $invitation->family->name }}</h4>
                                        <form action="{{ route("invitation.accept", $invitation) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-block btn-primary">
                                                {{ __('family-settings.accept_invitation') }}
                                            </button>
                                        </form>
                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

            @endif

            @if ($families)

                <div class="row justify-content-center">

                    <div class="col-12 col-sm-10 col-md-6">

                        <div id="familiesCarousel" class="carousel slide" data-interval="false">
                            <div class="carousel-inner">

                                @foreach ($families as $family)

                                    @php
                                        $active = ($loop->first) ? 'active' : '';
                                    @endphp

                                    <div class="carousel-item {{ $active }} text-center">
                                        <a href="{{ route('family.home', [$family]) }}">
                                            <h3>{{ $family->name }}</h3>
                                            {!! $family->photo(['rounded-circle', 'img-fluid', 'family-photo']) !!}
                                        </a>
                                    </div>
                                @endforeach


                            </div>
                        </div>

                        @if ($families->count() > 1)

                            <a class="carousel-control-prev piglet-carousel-control" href="#familiesCarousel" role="button" data-slide="prev">
                                <span class="fa fa-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next piglet-carousel-control" href="#familiesCarousel" role="button" data-slide="next">
                                <span class="fa fa-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        @endif

                    </div>

                </div>

            @else

                <a class="btn btn-lg btn-block btn-primary" href="{{ route('family.create') }}"><span class="fa fa-users"></span> {{ __('family.create-a-family') }}</a>

            @endif

        </div>

    </div>

@endsection
