@extends('layouts.marketing')

@section('marketing')

    <h1>Help</h1>

    <hr>

    <div class="row">

        <div class="col-12 col-md-3">
            @include('help.shared.nav', ['active' => $key])
        </div>

        <div class="col-12 col-md-9">

            @if (isset($key) && $key)
                @include("help.section.{$key}")
            @else
                Default help content
            @endif

        </div>

    </div>

@endsection
