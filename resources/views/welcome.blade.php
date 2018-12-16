@extends('layouts.app')


@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/welcome.css') }}" />
@endpush

@push('scripts')
{{--    <script src="{{ mix("js/welcome.js") }}"></script>--}}
@endpush

@section('content')


    <div class="row justify-content-center">

        <div class="col-12 col-md-10">

            <h1>{{ __('welcome.welcome') }}</h1>

            {!! __('welcome.introduction') !!}

            <hr>

        </div>

    </div>

@endsection
