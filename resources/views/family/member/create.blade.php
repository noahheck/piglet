@extends('layouts.app')

@section('title')
 - {{ $family->name }} - Add new family member
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
            <h2>Add a family member</h2>
        </div>

    </div>

    @include('family/member/_form', [
        'legend' => 'Details',
        'action' => route('family.member.store', [$family]),
        'method' => false,
        'cancelRoute' => route('family.member.index', [$family]),
    ])

@endsection
