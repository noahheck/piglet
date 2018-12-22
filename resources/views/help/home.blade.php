@extends('layouts.marketing')

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/help.css') }}" />
@endpush

@section('marketing')

    <div class="row">

        <div class="col-12 col-md-3">
            @include('help.shared.nav', ['active' => $key])
        </div>

        <div class="col-12 col-md-9">

            @if (isset($key) && $key)
                @include("help.section.{$key}")
            @else
                {{--Default help content--}}
                @include("help.section.home")
            @endif

        </div>

    </div>

@endsection
