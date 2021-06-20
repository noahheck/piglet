@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('contacts.contact') }} - {{ $contact->name }} - {{ __('form.edit') }}
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
            route('family.contacts.show', [$family, $contact]) => $contact->name ? $contact->name : '<No Name>',
        ],
        'location'   => __('form.edit'),
        'menu' => [
            ['type' => 'delete', 'href' => route('family.contacts.destroy', [$family, $contact, 'return' => url()->previous()]), 'text' => __('form.delete') . ' ' . __('contacts.contact')],
        ]
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.contacts._form', [
                'action'      => route('family.contacts.update', [$family, $contact]),
                'method'      => 'PUT',
                'cancelRoute' => old('return', url()->previous()),
            ])

        </div>

    </div>

@endsection
