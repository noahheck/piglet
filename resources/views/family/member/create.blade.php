@extends('layouts.app')

@section('title')
 - {{ $family->name }} - {{ __('family-members.add_new_family_member') }}
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
            route('family.member.index', [$family]) => __('family-members.family_members'),
        ],
        'location' => ucwords(__('form.add_new')),
    ])

    <div class="row">

        <div class="col-12">
            <h2>{{ __('family-members.add_new_family_member') }}</h2>
        </div>

    </div>

    @include('family/member/_form', [
        'legend'      => __('form.details'),
        'action'      => route('family.member.store', [$family]),
        'method'      => false,
        'cancelRoute' => route('family.member.index', [$family]),
    ])

@endsection
