@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('contacts.contact') }} - {{ __('contacts.add-new-contact') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.contacts.index', [$family]) => __('contacts.contacts'),
        ],
        'location'   => __('contacts.add-new-contact'),
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.contacts._form', [
                'action'      => route('family.contacts.store', [$family]),
                'method'      => false,
                'cancelRoute' => old('return', url()->previous()),
            ])

        </div>

    </div>

@endsection
