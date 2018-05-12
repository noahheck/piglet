@extends('layouts.app')

@section('title')
 - Create Family
@endsection

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family/form.css') }}" />
@endsection

@section('scripts')
    <script src="{{ asset("js/family-details-form.js") }}"></script>
@endsection

@section('content')

    <div class="row">

        <div class="col-12">

            @include('family/_form', [
                'legend' => 'Family Details',
                'action' => route('family.store'),
                'method' => false,
            ])

        </div>

    </div>

@endsection
