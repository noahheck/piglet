@extends('layouts.app')

@section('title')
 - {{ $family->name }} - {{ $member->firstName }} {{ $member->lastName }} - Edit
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/family.member._form.css') }}" />
@endsection

@section('scripts')
    <script src="{{ asset("js/family.member._form.js") }}"></script>
@endsection

@section('content')

    <div class="row">

        <div class="col-12">
            <h2>{{ $member->firstName }} {{ $member->lastName }}</h2>
        </div>

    </div>

    @include('family/member/_form', [
        'legend' => 'Edit Details',
        'action' => route('family.member.update', [$family, $member]),
        'method' => 'PUT',
        'cancelRoute' => route('family.member.show', [$family, $member]),
    ])

@endsection
