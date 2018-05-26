@extends('layouts.app')

@section('title')
 - {{ $family->name }} - {{ $member->firstName }} {{ $member->lastName }} - {{ __('form.edit') }}
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/family.member._form.css') }}" />
@endsection

@section('scripts')
    <script src="{{ asset("js/family.member._form.js") }}"></script>
@endsection

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.member.index', [$family])          => __('family-members.family_members'),
            route('family.member.show',  [$family, $member]) => $member->firstName,
        ],
        'location' => __('form.edit'),
    ])

    <div class="row">

        <div class="col-12">
            <h2>{{ $member->firstName }} {{ $member->lastName }}</h2>
        </div>

    </div>

    @include('family/member/_form', [
        'legend'      => ucwords(__('form.edit_details')),
        'action'      => route('family.member.update', [$family, $member]),
        'method'      => 'PUT',
        'cancelRoute' => route('family.member.show', [$family, $member]),
    ])

@endsection
