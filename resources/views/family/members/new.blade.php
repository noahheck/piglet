@extends('layouts.app')

@section('title')
 - {{ $family->name }} - {{ __('family-members.add_new_family_member') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/family.member._form.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset("js/family.member._form.js") }}"></script>
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.members.index', [$family]) => __('family-members.family_members'),
        ],
        'location' => ucwords(__('form.add_new')),
    ])

    <div class="row">

        <div class="col-12">
            <h2>{{ __('family-members.add_new_family_member') }}</h2>
        </div>

    </div>

    @include('family/members/_form', [
        'legend'      => __('form.details'),
        'action'      => route('family.members.store', [$family]),
        'method'      => false,
        'cancelRoute' => route('family.members.index', [$family]),
    ])

@endsection
