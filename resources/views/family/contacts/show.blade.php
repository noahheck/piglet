@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('contacts.contacts') }} - {{ $contact->name }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
{{--    <script type="text/javascript" src="{{ mix('js/family.merchants.index.js') }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.contacts.index', [$family])   => __('contacts.contacts'),
        ],
        'location'   => $contact->name ? $contact->name : '<No Name>',
        'menu' => [
            ['type' => 'link', 'href' => route('family.contacts.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('contacts.add-new-contact')],
            ['type' => 'link', 'href' => route('family.contacts.edit', [$family, $contact]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center">
                        <span class="fa fa-user" style="font-size: 150px;"></span>
                    </div>
                    <hr>
                    <h3>{{ $contact->name }}</h3>
                </div>
                <a class="card-footer" href="{{ route('family.contacts.edit', [$family, $contact]) }}">
                    {{ __('form.edit') }}
                </a>
            </div>

        </div>

        <div class="col-12 col-md-9">

            <h2 style="border-bottom: 1px solid #ccc;">
                @if ($contact->fullname)
                    {{ $contact->fullname }}
                @else
                    <em>&lt;No Name&gt;</em>
                @endif
            </h2>

        </div>

    </div>

@endsection
