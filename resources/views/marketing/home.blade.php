@extends('layouts.app')


@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endpush

@section('content')

    <h2>Hello</h2>

@endsection
